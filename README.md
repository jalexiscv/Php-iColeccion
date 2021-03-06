iColeccion v2.1 - Insside Framewok®
=========
Una colección representará de manera genérica un grupo de objetos llamados elementos. Esta clase por tanto será usada para pasar colecciones de elementos o manipularlos de la manera más trasparente y simplificada posible. Aclarando que PHP nativamente permite iterar colecciones objetos, pero sin embargo este solo permite trabajar con las propiedades públicas del objeto, si tu objeto tiene propiedades públicas sus valores serán visibles en cada iteración, pero si se usa el concepto de encapsulación de objetos, es muy probable que los objetos generados posean tanto propiedades públicas, como privadas y protegidas con su respectivo get y set, y consecuentemente las variables privadas no serán visibles en la iteración. Aquí es donde entra Iterator e IteratorAggregate dos interfaces que utilizadas permiten definir su propia lógica para retornar un valor por cada iteración. La interfaz IteratorAggregate permite a nuestra clase contener objetos vectoriales e incluso matrices de objetos donde lo único que hay que hacer para accederlas es iterar en el buen sentido de la palabra y así obtener los datos contenidos. Quienes estructuradamente programan clases e interfaces en PHP habrán tenido experiencias donde no es posible mediante la invocación directa de los objetos como vectores tradicionales, obtener sus contenidos. IteratorAggregate ayuda a separar responsabilidades (Separation of Concerns SoC), En caso de que desees iterar sobre los objetos contenidos por otro objeto. El factor tiempo también es considerable ya que si la colección de objetos almacenados estructuradamente es relativmente extensa una mecánica tradicional podría tardar varios segundos en recorrer el objeto base y retornar los objetos adyacentes. IteratorAggregate es mucho más rápido que Iterator y da un uso similar a los elementos que componen el objeto como si se tratara de nodos de un documento XML, recorridos a la velocidad de acceso de una variable cargada en memoria, Iterador es uno de los patrones de diseño más conocidos, gracias al uso que hacen de él distintos lenguajes de programación, como Python, Java, C++ y el propio PHP. 
Es de recordar que en diseño de software, el patrón de diseño Iterador, define una interfaz que declara los métodos necesarios para acceder secuencialmente a un grupo de objetos de una colección por lo tanto esta clase puede administrar colecciones de objetos como si fuese una matriz de datos implementando un SPL IteratorAggregate  y un ArrayAccess como un conjunto regular . En esta versión se puede establecer(set) , obtener(get), verificar (check) , limpiar(clear) y elementos de la lista dado un camino que puede especificar una entrada en una matriz anidada.

Nota: Esta clase esta inspirada en un concepto reducido de:
https://docs.oracle.com/javase/7/docs/api/java/util/Collections.html

## Requerimientos
* PHP 4 or PHP 5

## Contactenme en:
* **Perfil**: http://about.me/jalexiscv
* **Correo Electrónico**: jalexiscv@gmail.com
* **Whatsapp**: +573173997946

## Donaciones:
* **Paypal**: jalexiscv@gmail.com
