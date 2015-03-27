<?php
//ask for input
fwrite(STDOUT, "Enter your name: ");

// get input
$name = trim(fgets(STDIN));

// write input back
fwrite(STDOUT, "Hello, $name!");
print_r($argv);

//提示用户输入，类似Python

$fs = true;

do{
	if($fs){
		fwrite(STDOUT,'请输入您的博客名：');
		$fs = false;
	}else{
		fwrite(STDOUT,'抱歉，博客名不能为空，请重新输入您的博客名：');
	}

	$name = trim(fgets(STDIN));

}while(!$name);

echo '您输入的信息是：'.$name."\r\n";
