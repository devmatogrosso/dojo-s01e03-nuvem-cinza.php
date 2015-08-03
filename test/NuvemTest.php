<?PHP

use App\Nuvem;

class NuvemTest extends PHPUnit_Framework_TestCase
{

	public function testGeracaoMapa()
	{
		$mapaInicio = [
			['.', '.', '*', '.', '.', '.', '*', '*'],
			['.', '*', '*', '.', '.', '.', '.', '.'],
			['*', '*', '*', '.', 'A', '.', '.', 'A'],
			['.', '*', '.', '.', '.', '.', '.', '.'],
			['.', '*', '.', '.', '.', '.', 'A', '.'],
			['.', '.', '.', 'A', '.', '.', '.', '.'],
			['.', '.', '.', '.', '.', '.', '.', '.']
		];

		$mapaFinal = [
			['*', '*', '*', '*', '*', '*', '*', '*'],
			['*', '*', '*', '*', '*', '*', '*', '*'],
			['*', '*', '*', '*', '*', '.', '*', '*'],
			['*', '*', '*', '*', '.', '.', '.', '.'],
			['*', '*', '*', '*', '.', '.', 'A', '.'],
			['*', '*', '*', 'A', '.', '.', '.', '.'],
			['.', '*', '.', '.', '.', '.', '.', '.']
		];

		$nuvem = new Nuvem($mapaInicio);

		$nuvem->advanceDay();
		$nuvem->advanceDay();

		$actualMap = $nuvem->getActualMap();

		$this->assertEquals($mapaFinal, $actualMap);
		
	}
	
	public function testeQuantidadeDias(){
		
		$mapaInicio = [
			['.', '.', '*', '.', '.', '.', '*', '*'],
			['.', '*', '*', '.', '.', '.', '.', '.'],
			['*', '*', '*', '.', 'A', '.', '.', 'A'],
			['.', '*', '.', '.', '.', '.', '.', '.'],
			['.', '*', '.', '.', '.', '.', 'A', '.'],
			['.', '.', '.', 'A', '.', '.', '.', '.'],
			['.', '.', '.', '.', '.', '.', '.', '.']
		];

		$nuvem = new Nuvem($mapaInicio);

		$nuvem->advanceDay();
		$nuvem->advanceDay();

		$this->assertEquals(3, $nuvem->getDaysElapsed());
		
	}

	public function testCoberturaAviao(){
		
		
		$mapaInicio = [
			['.', '.', '*', '.', '.', '.', '*', '*'],
			['.', '*', '*', '.', '.', '.', '.', '.'],
			['*', '*', '*', '.', 'A', '.', '.', 'A'],
			['.', '*', '.', '.', '.', '.', '.', '.'],
			['.', '*', '.', '.', '.', '.', 'A', '.'],
			['.', '.', '.', 'A', '.', '.', '.', '.'],
			['.', '.', '.', '.', '.', '.', '.', '.']
		];
		
		$nuvem = new Nuvem($mapaInicio);



		$airports = $nuvem->getCoveredAirports();
		$this->assertEquals(sizeof($airports), 0);

		$nuvem->advanceDay();

		$airports = $nuvem->getCoveredAirports();
		$this->assertEquals(sizeof($airports), 0);

		$nuvem->advanceDay();

		$airports = $nuvem->getCoveredAirports();
		$this->assertEquals(sizeof($airports), 2);

	}

}