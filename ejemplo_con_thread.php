<?php
gc_disable();
$hora = new DateTime();
$empieza = $hora->getTimestamp();

function asignarDatos($csvFile)
{
	require 'vendor/autoload.php';
	$faker = Faker\Factory::create('es_ES');
	$csv = fopen($csvFile, "a");
	fputcsv($csv, array(
		'Id',
		'Ingresado',
		'Nombre(s)',
		'Apellido(s)',
		'Email',
		'Email Empresa',
		'Telefono',
		'Movil',
		'Ip',
		'Empresa',
		'Puesto',
		'Direccion',
	));
	foreach(range(1,6000) as $i)
	{
		echo(".");
		fputcsv($csv, array(
			$i,
			$faker->unixTime,
			$faker->firstName,
			$faker->lastName,
			$faker->email,
			$faker->companyEmail,
			$faker->phoneNumber,
			$faker->e164PhoneNumber,
			$faker->ipv6,
			$faker->company,
			$faker->jobTitle,
			$faker->address,
		));
	}
	fclose($csv);
}

class hiloDeProceso extends Thread
{
	private $workerId;
	private $csvFile;
	
	public function __construct($id, $csvFile)
	{
		$this->workerId = $id;
		$this->csvFile = $csvFile.$id.".csv";
	}
	
	public function run()
	{
		asignarDatos( $this->csvFile);
	}
}

$proc = array();
foreach(range(1,4) as $i)
{
	$proc[$i] = new hiloDeProceso($i, "salida_datos");
	$proc[$i]->start();
}

foreach(range(1,4) as $i)
{
	$proc[$i]->join();
}


$hora = new DateTime();
$termina = $hora->getTimestamp();
echo("\nTardó apróximadamente: ".($termina - $empieza)."segs.\n");
?>
