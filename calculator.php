<html>
<head><title>Calculator</title></head>
<body>

<h1>Calculator</h1>
(Ver 1.0 10/10/2014 by Larry Liu)<br />
Type an expression in the following box (e.g., 10.5+20*3/25).
<p>
    <form method="GET">
        <input cols="60" rows="8" type="text" name="expr">
        <input type="submit" value="Calculate">
    </form>
</p>

<ul>
    <li>Only numbers and +,-,* and / operators are allowed in the expression.
    <li>The evaluation follows the standard operator precedence.
    <li>The calculator does not support parentheses.
    <li>The calculator handles invalid input "gracefully". It does not output PHP error messages.
</ul>

Here are some(but not limit to) reasonable test cases:
<ol>
  <li> A basic arithmetic operation:  3+4*5=23 </li>
  <li> An expression with floating point or negative sign : -3.2+2*4-1/3 = 4.46666666667, 3+-2.1*2 = -1.2 </li>
  <li> Some typos inside operation (e.g. alphabetic letter): Invalid input expression 2d4+1 </li>
</ol>

<h2>Result</h2>
<?php
function calc($equation)
{
    // Remove whitespaces
    $equation = preg_replace('/\s+/', '', $equation);
    // Numbers including integer and real numbers
    $number = '((0|[1-9]\d*)(\.\d*)?([eE][+\-]?\d+)?|pi|π)';
    // Support all functions provided by php
    $functions = '(sinh?|cosh?|tanh?|acosh?|asinh?|atanh?|exp|log(10)?|deg2rad|rad2deg
|sqrt|pow|abs|intval|ceil|floor|round|(mt_)?rand|gmp_fact)';
    // Support operators: /, *, +, -
    $operators = '[\/*\^\+-]';
    // Define regular expression
    $regExp = '/^(-?('.$number.'|'.$functions.'\s*\((?1)+\)|\((?1)+\))('.$operators.'(?1))?)+$/';
    // See if $equation match the regular expression
    if (preg_match($regExp, $equation))
    {
      // See if there exists divided by 0: "0/0"
      $zeroExp = '/(\/-?0)(?!\.)/';
      if(preg_match($zeroExp, $equation))
      {
        $result = "Division by zero error!";
        return $result;
      }
      // Keep the old equation
      $oldEquation = $equation;
      
      $minusExp = '(--'.$number.')';
      // See if there are negative numbers "-$number" in the equation
      if(preg_match_all($minusExp, $equation, $matches))
      {
        // Add parentheses to all "-$number": "(-$number)"
        $numOfCols = count($matches[0]);
        for($i=0; $i<$numOfCols; $i++) {
          $equation = preg_replace('/'.substr($matches[0][$i], 1).'/', '('.substr($matches[0][$i], 1).')', $equation);
        }
      }

      
      $equation = preg_replace('!pi|π!', 'pi()', $equation);
      
      eval('$result = '.$equation.';');

      $result = "$oldEquation = $result";
    }
    else
    {
      $result = "Invalid Expression";
    }

    return $result;
}
$result = calc($_GET['expr']);
echo $result;

?>
</body>
</html>