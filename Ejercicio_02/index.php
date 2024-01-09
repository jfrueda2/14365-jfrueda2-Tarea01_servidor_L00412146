<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Menú Interactivo</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #fff;
    }

    #menu {
      text-align: center;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #menu h2 {
      margin-bottom: 20px;
    }

    button {
      margin-bottom: 10px;
      padding: 10px 20px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #fff;
      color: #333;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #eee; 
    }

    button:last-child {
      margin-bottom: 0;
    }

    div[id^="opcion"] {
      display: none;
    }

    #resultado {
      margin-top: 20px;
    }

    div[id^="opcion"] {
      display: none;
      text-align: center;
      margin-top: 20px;
      font-size: 16px;
    }

    div[id^="opcion"] form {
      margin-top: 10px;
    }

    div[id^="opcion"] input[type="number"],
    div[id^="opcion"] input[type="submit"] {
      padding: 8px 16px;
      font-size: 14px;
    }
  </style>
</head>
<body>

<div id="menu">
  <h2>MENÚ</h2>
  <button onclick="mostrarRecuadro('opcion1')">1. FIBONACCI</button>
  <hr>
  <button onclick="mostrarRecuadro('opcion2')">2. CUBO</button>
  <hr>
  <button onclick="mostrarRecuadro('opcion3')">3. FRACCIONARIOS</button>
  <hr>
  <button onclick="salir()">SALIR</button>
  <hr>
</div>

<div id="opcion1" style="display: none;">
  <h3>Opción 1: Fibonacci</h3>
  <form action="" method="post">
    <label for="numFibonacci">Ingrese un valor para calcular los primeros números de Fibonacci (Entre 1 y 50): </label>
    <input type="number" name="numFibonacci" required min="1" max="50">
    <br>
    <input type="submit" value="Calcular Fibonacci">
  </form>
</div>

<div id="opcion2" style="display: none;">
  <h3>Opción 2: Cubo</h3>
  <form action="" method="post">
    <label for="maxCubo">Ingrese un valor máximo para buscar los números que cumplen la condición: </label>
    <input type="number" name="maxCubo" required min="1" max="1000000">
    <br>
    <input type="submit" value="Buscar Números">
  </form>
</div>

<div id="opcion3" style="display: none;">
  <h3>Opción 3: Fraccionarios</h3>
  <form action="" method="post">
    <label for="numeradorA">Ingrese el numerador A: </label>
    <input type="number" name="numeradorA" required>
    <br>
    <label for="numeradorB">Ingrese el denominador B: </label>
    <input type="number" name="numeradorB" required>
    <br>
    <label for="numeradorC">Ingrese el numerador C: </label>
    <input type="number" name="numeradorC" required>
    <br>
    <label for="numeradorD">Ingrese el denominador D: </label>
    <input type="number" name="numeradorD" required>
    <br>
    <input type="submit" value="Calcular Expresión Matemática">
  </form>
</div>

<div id="resultado">
  <!-- Aquí se mostrarán los resultados -->
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['numFibonacci'])) {
        $num = (int)$_POST['numFibonacci'];
        if ($num >= 1 && $num <= 50) {
          $resultado = calcularFibonacci($num);
          echo "Los primeros $num números de Fibonacci son: " . implode(', ', $resultado);
        } else {
          echo "Número fuera del rango permitido o inválido.";
        }
      } elseif (isset($_POST['maxCubo'])) {
        $maxCubo = (int)$_POST['maxCubo'];
        $resultado = buscarNumerosCubo($maxCubo);
        echo "Los números que cumplen la condición son: " . implode(', ', $resultado);
      } elseif (isset($_POST['numeradorA']) && isset($_POST['numeradorB']) && isset($_POST['numeradorC']) && isset($_POST['numeradorD'])) {
        $A = (int)$_POST['numeradorA'];
        $B = (int)$_POST['numeradorB'];
        $C = (int)$_POST['numeradorC'];
        $D = (int)$_POST['numeradorD'];
        $resultado = calcularExpresionMatematica($A, $B, $C, $D);
        echo "El resultado de la expresión A + B * C - D es: $resultado";
      }
    }

    function calcularFibonacci($N) {
      $fib = [1, 1];
      for ($i = 2; $i < $N; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
      }
      return $fib;
    }

    function buscarNumerosCubo($max) {
      $numerosCumplenCondicion = [];
      for ($i = 1; $i <= $max; $i++) {
        if ($i === calcularCuboDigitos($i)) {
          $numerosCumplenCondicion[] = $i;
        }
      }
      return $numerosCumplenCondicion;
    }

    function calcularCuboDigitos($num) {
      $digitos = str_split($num);
      $cuboDigitos = array_map(function ($digit) {
        return pow((int)$digit, 3);
      }, $digitos);
      return array_sum($cuboDigitos);
    }

    function calcularExpresionMatematica($A, $B, $C, $D) {
      return $A + $B * $C - $D;
    }
  ?>

  <script>
    function mostrarRecuadro(opcion) {
      resetearResultado();
      document.getElementById('opcion1').style.display = 'none';
      document.getElementById('opcion2').style.display = 'none';
      document.getElementById('opcion3').style.display = 'none';
      document.getElementById(opcion).style.display = 'block';
    }

    function salir() {
      resetearResultado();
      window.location.href = "../index.html";
    }

    function resetearResultado() {
      document.getElementById('resultado').innerHTML = "";
    }
  </script>
</div>
</body>
</html>
