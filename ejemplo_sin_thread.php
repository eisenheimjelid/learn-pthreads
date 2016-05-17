<?php
$hora = new DateTime();
$empieza = $hora->getTimestamp();

class ejemplo
{
	public function asignarDatos()
	{
		require 'vendor/autoload.php';
		$faker = Faker\Factory::create('es_ES');
		$csv = fopen("salida_datos.csv", "a");
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
		foreach(range(1,5000) as $i)
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
}

$iniciar = new Ejemplo();
$iniciar->asignarDatos();

$hora = new DateTime();
$termina = $hora->getTimestamp();
echo("\nTardó apróximadamente: ".($termina - $empieza)."segs.\n");
?>
