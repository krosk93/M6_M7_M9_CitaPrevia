<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Estudi;
use App\Dia;
class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
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

			DB::table ( 'estudis' )->insert ( [
					'nom_estudi' => $valor
			] );
			$estudi = Estudi::where ( 'nom_estudi', $valor )->first ();
			DB::table ( 'dias' )->insert ( [
					'dia' => $data,
					'estudi_id' => $estudi->id
			] );
			$dia = Dia::orderBy ( 'created_at', 'desc' )->first ();

			$horaInici = Carbon::create ( $dia->year, $dia->month, $dia->day, 9 );
			$horaFi = Carbon::create ( $dia->year, $dia->month, $dia->day, 13 );
			while ( $horaInici < $horaFi ) {
				for($i = 0; $i < 4; $i ++) {
					DB::table ( 'citas' )->insert ( [
							'hora' => $horaInici->format ( 'H:i' ),
							'estat' => 'buit',
							'dia_id' => $dia->id
					] );
				}
				$horaInici = $horaInici->addMinutes ( 10 );
			}
			$data = $data->addDays ( 1 );
		}
	}
}
