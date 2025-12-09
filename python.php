


<form action="test.py" method="post">
<button>Click</button>
</form>
<?php 
/*

# emy_list = ['s','y','z']
# x = []
# for uu in emy_list:
#     x.append(emy_list.pop())
#     print(x)

*/

$output = shell_exec('ls -lart');
echo "<pre>$output</pre>";

    $command = escapeshellcmd('python test.py');
    $output = shell_exec($command);
    echo $output;

?>

<?php
exec('sudo python test.py');
?>