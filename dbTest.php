use PHPUnit\Framework\TestCase;

class dbTest extends TestCase {
    protected $db;

    protected function setUp(): void {
        $this->db = $this->getMockBuilder(db::class)
                         ->disableOriginalConstructor()
                         ->getMock();
    }

    public function testGetAllKasir() {
        // Mocking hasil query database
        $expectedResult = [
            [
                'ID_Kasir' => 1,
                'Username' => 'kasir1',
                'NamaKasir' => 'Kasir Satu',
                'Alamat' => 'Jl. Contoh 1',
                'NomorHP' => '08123456789',
                'NomorKTP' => '1234567890'
            ],
            [
                'ID_Kasir' => 2,
                'Username' => 'kasir2',
                'NamaKasir' => 'Kasir Dua',
                'Alamat' => 'Jl. Contoh 2',
                'NomorHP' => '08123456788',
                'NomorKTP' => '0987654321'
            ]
        ];

        // Mengatur return value dari getAllKasir
        $this->db->method('getAllKasir')
                 ->willReturn($expectedResult);

        // Assert bahwa hasilnya sesuai yang diharapkan
        $this->assertEquals($expectedResult, $this->db->getAllKasir());
    }
}
