<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use App\Estudi;
use App\Dia;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$faker = Faker::create();
		// $this->call(UsersTableSeeder::class);
		// Creem un usuari
		DB::table ( 'users' )->insert ( [
				'name' => 'admin',
				'email' => 'admin@gmail.com',
				'password' => bcrypt ( 'admin' )
		] );
		$data = Carbon::create ( 2018, 7, 4 );
		$array = array (
				'ESO',
				'Batx',
				'CAI',
				'Farmàcia, Jurídics',
				'Activitats comercials',
				'SMX',
				'Gestió administrativa'
		);
		foreach ( $array as &$valor ) {

			/*
			 * He realitzat alguns canvis al seeder donat que generava totes les cites en un mateix dia.
			 * Després m'he adonat que el que passava es que a $horaInici i $horaFi havia de ser $date
			 * en comptes de $dia, pero com que els canvis també son per a millor (eviten duplicats),
			 * els he deixat
			 */

			// DB::table ( 'estudis' )->insert ( [
			// 		'nom_estudi' => $valor
			// ] );
			// $estudi = Estudi::where ( 'nom_estudi', $valor )->first ();

			$estudi = Estudi::firstOrCreate(['nom_estudi' => $valor]);

			// DB::table ( 'dias' )->insert ( [
			// 		'dia' => $data,
			// 		'estudi_id' => $estudi->id
			// ] );
			// $dia = Dia::orderBy ( 'created_at', 'desc' )->first ();

			$dia = Dia::firstOrCreate([
				'dia' => $data,
				'estudi_id' => $estudi->id
			]);

			// $horaInici = Carbon::create ( $dia->year, $dia->month, $dia->day, 9 );
			// $horaFi = Carbon::create ( $dia->year, $dia->month, $dia->day, 13 );

			$horaInici = $data->copy()->setTime(9,0,0);
			$horaFi = $data->copy()->setTime(13,0,0);

			while ( $horaInici < $horaFi ) {
				for($i = 0; $i < 4; $i ++) {
					$estat = $faker->randomElement(array('buit', 'ple', 'bloquejat'));
					if($estat === 'ple') $email = $faker->safeEmail();
					else $email = NULL;

					DB::table ( 'citas' )->insert ( [
							'hora' => $horaInici->format ( 'H:i' ),
							'estat' => $estat,
							'email' => $email,
							'dia_id' => $dia->id
					] );
				}
				$horaInici = $horaInici->addMinutes ( 10 );
			}
			$data = $data->addDays ( 1 );
		}
	}
}
