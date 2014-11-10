<?php

/*
 *  Coleccion v2.0
 * 
 * Una colección representará de manera genérica un grupo de objetos llamados elementos. Esta clase por tanto será 
 * usada para pasar colecciones de elementos o manipularlos de la manera más trasparente y simplificada posible. 
 * Aclarando que PHP  nativamente permite iterar objetos, sin embargo este solo permite trabajar con las propiedades 
 * públicas del objeto, si tu objeto tiene propiedades públicas sus valores serán visibles en cada iteración, pero si se usa el 
 * concepto de encapsulación de objetos, es muy probable que los objetos generados posean tanto propiedades 
 * públicas, como privadas y protegidas con su respectivo get y set, y consecuentemente las variables privadas no 
 * serán visibles en la iteración. Aquí es donde entra Iterator e IteratorAggregate dos interfaces que utilizadas 
 * permiten definir su propia lógica para retornar un valor por cada iteración. La interfaz IteratorAggregate permite 
 * a nuestra clase contener objetos vectoriales e incluso matrices de objetos donde lo único que hay que hacer para 
 * accederlas es iterar en el buen sentido de la palabra y así obtener los datos contenidos. Quienes estructuradamente 
 * programan clases e interfaces en PHP habrán tenido experiencias donde no es posible mediante la invocación 
 * directa de los objetos como vectores tradicionales, obtener sus contenidos. IteratorAggregate ayuda a separar 
 * responsabilidades (Separation of Concerns SoC), En caso de que desees iterar sobre los objetos contenidos por 
 * otro objeto. El factor tiempo también es considerable ya que si la colección de objetos almacenados 
 * estructuradamente es relativmente extensa una mecánica tradicional podría tardar varios segundos en recorrer el 
 * objeto base y retornar los objetos adyacentes. IteratorAggregate es mucho más rápido que Iterator y da un uso 
 * similar a los elementos que componen el objeto como si se tratara de nodos de un documento XML, recorridos a la 
 * velocidad de acceso de una variable cargada en memoria, Iterador es uno de los patrones de diseño más conocidos, 
 * gracias al uso que hacen de él distintos lenguajes de programación, como Python, Java, C++ y el propio PHP.
 * Es de recordar que en diseño de software, el patrón de diseño Iterador, define una interfaz que declara los métodos 
 * necesarios para acceder secuencialmente a un grupo de objetos de una colección por lo tanto esta clase puede 
 * administrar colecciones de objetos como si fuese una matriz de datos implementando un SPL IteratorAggregate  y 
 * un ArrayAccess como un conjunto regular . En esta versión se puede establecer(set) , obtener(get), verificar (check) , 
 * limpiar(clear) y elementos de la lista dado un camino que puede especificar una entrada en una matriz anidada.
 * 
 * Nota: Esta clase esta inspirada en un concepto reducido de:
 * https://docs.oracle.com/javase/7/docs/api/java/util/Collections.html
 * 
 * @author Jose Alexis Correa Valencia [http://www.insside.com]
 * @package Insside
 * @subpackage librerias
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * Copyright (c) 2012, All rights reserved.
 */

class Coleccion implements IteratorAggregate, ArrayAccess {

    private $items;

    public function __construct(array $items = NULL) {
        $this->items = $items;
    }

    /**
     * Sets $value in $array where $key is the recursive Path inside $array
     *
     * @param string $path
     * @param mixed $value
     * @return array
     */
    public function set($path, $value) {
        if ($path == NULL) {
            $this->items = $value;
        } else {
            $this->_set( $this->items, $path, $value);
        }
    }

    private function _set(&$array, $path, $value) {
        if (!$this->isAcceptedArrayType($array)) {
            $array = array();
        }

        $parts = explode('.', $path);

        if (count($parts) > 1) {
            $part = array_shift($parts);

            if (!$this->isAcceptedArrayType($array)) {
                $array = array();
            }

            if (!array_key_exists($part, $array)) {
                $array[$part] = null;
            }
            
            $array[$part] = $this->_set($array[$part], join('.', $parts), $value);
        } else {
            $array[$path] = $value;
        }
        
        return $array;
    }

    /**
     * @param string $path
     * @param mixed $default
     * @return mixed
     */
    public function get($path, $default = NULL) {
        $has = $this->_has(explode('.', $path), $this->items);
        if ($has[0]) {

            return is_array($has[1]) ? new Collection($has[1]) : $has[1];
        } else {
            return $default;
        }

        /*
          return $this->getValue(
          explode('.', $key),
          $this->items,
          $default
          );
         */
    }

    /*
    private function getValue(array &$indexs, array $value, $default = NULL) {
        $key = array_shift($indexs);
        if (empty($indexs)) {
            if (!array_key_exists($key, $value)) {
                return $default;
            }

            if (is_array($value[$key])) {
                return new Collection($value[$key]);
            } else {
                return $value[$key];
            }
        } else {
            return $this->getValue($indexs, $value[$key], $default);
        }
    }
     */
    
    
    /**
     * Determines if $path exists in $array
     *
     * @param string $path
     * @return array
     */
    public function has($path) {
        $has = $this->_has(explode('.', $path), $this->items);
        return $has[0];
    }

    private function _has($keys, $value) {
        $key = array_shift($keys);
        if (empty($keys)) {
            $result = array(FALSE);
            if (array_key_exists($key, $value)) {
                $result = array(TRUE, $value[$key]);
            }
            return $result;
        } else {
            return $this->_has($keys, $value[$key]);
        }
    }

    /**
     * get lists array of $key and $value
     * 
     * @param string $key
     * @param mixed $value
     * @return array
     */
    public function lists($key, $value) {
        $result = array();
        foreach ($this->items as $item) {
            $result[$item[$key]] = $item[$value];
        }
        return new Collection($result);
    }

    /**
     * get extract of $key 
     * 
     * @param string $key
     * @return array
     */
    public function extract($key) {
        $result = array();
        foreach ($this->items as $item) {
            $result[] = $item[$key];
        }
        return new Collection($result);
    }

    public function join($glue) {
        return implode($glue, $this->items);
    }

    /**
     * get max element in array by $key
     * 
     * @param string $key
     * @return mixed
     */
    public function max($key = FALSE) {
        if ($key) {
            return $this->extract($key)->max();
        } else {
            return max($this->items);
        }
    }

    
    /**
     * clear path form array
     * 
     * @param string $path
     * @return array
     */
    public function clear($path) {
        $this->clearKey(
                $this->items,
                explode('.', $path));
    }

    /**
     * @param array $array
     * @param array $path
     * @return array
     */
    private function clearKey(array &$array, array $path) {
        if (count($path)) {
            $key = array_shift($path);
            if (array_key_exists($key, $array)) {
                if (empty($path)) {
                    unset($array[$key]);
                    
                } else {
                    $this->clearKey($array[$key], $path);
                }
            }
        }
    }
    
    public function offsetExists($offset) {
        $this->has($key);
    }

    public function offsetGet($offset) {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value) {
        return $this->set($offset, $value);
    }

    public function offsetUnset($offset) {
        if ($this->has($offset))
            unset($this->items[$offset]);
    }

    public function getIterator() {
        return new ArrayIterator($this->items);
    }

    
    /**
     * Returns true when $array is an array or an ArrayObject
     *
     * @param mixed $array
     * @return bool
     */
    private function isAcceptedArrayType($array) {
        return is_array($array) || $array instanceof ArrayObject;
    }
}
