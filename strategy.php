<?php

namespace RefactoringGuru\estrategia\Conceptual;

// La clase contexto define la interfaz de estrategia para los clientes
class contexto {
    // La clase contexto tiene una referencia con una de las Estrategias. Debería funcionar con todas las Estrategias mediante la interfaz de estrategia 
    private $estrategia;

    // La clase contexto acepta una estrategia a través del constructor, pero también proporciona un configurador para cambiarla en tiempo de ejecución.
    public function __construct(estrategia $estrategia) {
        $this->estrategia = $estrategia;
    }

    // La clase contexto permite remplazar una Estrategia mientras está en ejecucion
    public function setestrategia(estrategia $estrategia) {
        $this->estrategia = $estrategia;
        echo "La estrategia ha cambiado <br>";
    }

    // El contexto delega algo de trabajo al objeto de la estrategia en lugar de implementar múltiples versiones del algoritmo por sí solo.
    public function realizarAccion(): void {
        
        echo "La clase contexto va a ordenar los datos de la clase usando las estrategias\n";
        $result = $this->estrategia->hacerAlgoritmo(["a", "b", "c", "d", "e"]);
        echo implode(",", $result) . "<br>";

    }
}

//La interfaz de estrategia declara operaciones comunes a todas las versiones compatibles de algún algoritmo.
interface estrategia {
    public function hacerAlgoritmo(array $array): array;
}

// Concrete Strategies implementa el algoritmo siguiendo la interfaz de la estrategia base.
class ConcreteStrategyA implements estrategia {
    public function hacerAlgoritmo(array $array): array {
        sort($array);
        return $array;
    }
}

class ConcreteStrategyB implements estrategia {
    public function hacerAlgoritmo(array $array): array {
        rsort($array);
        return $array;
    }
}

// El cliente elige una estrategia concreta y la pasa al contexto.
$contexto = new contexto(new ConcreteStrategyA());
echo "Cliente: la estrategia esta configurada en modo normal <br>";
$contexto->realizarAccion();

$contexto->setestrategia(new ConcreteStrategyB());
echo "Cliente: la estrategia esta configurada en modo inversa <br>";
$contexto->realizarAccion();
