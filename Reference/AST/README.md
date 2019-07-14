# 语法树

最简单的代码，实现了一个简单的数学表达式的语法树，并利用语法树求```3+(1+2)```的值。

全树有A,B,C,D,E共5个节点。

       A(+)
      /    \
    B(3)    C(+)
           /   \
         D(1)   E(2)

主要代码：

	require 'autoload.php';
	
	use MathInterpreter\Add;
	use MathInterpreter\Number;
	
	$A = new Add();
	$B = new Number(3);
	$C = new Add();
	$D = new Number(1);
	$E = new Number(2);
	$C->add($D);
	$C->add($E);
	$A->add($B);
	$A->add($C);
	
	echo $A->getValue();