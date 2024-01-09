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
  <button onclick="mostrarRecuadro('opcion1')">1. FACTORIAL</button>
  <br>
  <button onclick="mostrarRecuadro('opcion2')">2. PRIMO</button>
  <br>
  <button onclick="mostrarRecuadro('opcion3')">3. SERIE MATEMATICA</button>
  <br>
  <button onclick="salir()">4. SALIR</button>
</div>


<div id="opcion1">
  <h3>Opción 1: Factorial</h3>
  <form action="" method="post">
    <label for="numFactorial">Ingrese un valor para calcular su factorial (Entre 0 y 10): </label>
    <input type="number" name="numFactorial" required min="0" max="10">
    <br>
    <input type="submit" value="Calcular Factorial">
  </form>
</div>

<div id="opcion2">
  <h3>Opción 2: Primo</h3>
  <form action="" method="post">
    <label for="numPrimo">Ingrese un valor para verificar si es primo: </label>
    <input type="number" name="numPrimo" required min="0">
    <br>
    <input type="submit" value="Verificar Primo">
  </form>
</div>

<div id="opcion3">
  <h3>Opción 3: Serie Matemática</h3>
  <form action="" method="post">
    <label for="numTerminos">Ingrese el valor de términos para la serie matemática: </label>
    <input type="number" name="numTerminos" required min="0">
    <br>
    <input type="submit" value="Calcular Serie">
  </form>
</div>

<div id="resultado">
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['numFactorial'])) {
        $num = (int)$_POST['numFactorial'];
        if ($num >= 0 && $num <= 10) {
          $resultado = calcularFactorial($num);
          echo "El factorial de $num es: $resultado";
        } else {
          echo "Número fuera del rango permitido o inválido.";
        }
      } elseif (isset($_POST['numPrimo'])) {
        $numPrimo = (int)$_POST['numPrimo'];
        $resultado = esPrimo($numPrimo) ? "es" : "no es";
        echo "$numPrimo $resultado primo.";
      } elseif (isset($_POST['numTerminos'])) {
        $numTerminos = (int)$_POST['numTerminos'];
        $resultado = calcularSerieMatematica($numTerminos);
        echo "El resultado de la serie es: $resultado";
      }
    }

    function calcularFactorial($n) {
      if ($n === 0 || $n === 1) {
        return 1;
      } else {
        return $n * calcularFactorial($n - 1);
      }
    }

    function esPrimo($num) {
      if ($num < 2) {
        return false;
      }
      for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i === 0) {
          return false;
        }
      }
      return true;
    }

    function calcularSerieMatematica($numTerminos) {
      $resultado = 0;
      for ($i = 1; $i <= $numTerminos; $i++) {
        $termino = pow($i, 2) / calcularFactorial($i);
        if ($i % 2 === 0) {
          $resultado -= $termino;
        } else {
          $resultado += $termino;
        }
      }
      return $resultado;
    }
  ?>
</div>

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
</body>
</html>
