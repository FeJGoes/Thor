<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $senhaPadrao = Hash::make('Abc102030*');

        DB::table('clientes')->insert([
            ['ativo' => true,'nome' => 'Claudianus Boast','email' => 'cboast0@fastcompany.com','senha' => $senhaPadrao, 'telefone' => '(19) 957645371','estado' => 'SP','cidade' => 'Araraquara','data_nascimento' => '1993-06-07'],
            ['ativo' => true,'nome' => 'Loni Jennions','email' => 'ljennions1@va.gov','senha' => $senhaPadrao, 'telefone' => '(19) 905613161','estado' => 'SP','cidade' => 'Limeira','data_nascimento' => '1985-05-09'],
            ['ativo' => true,'nome' => 'Margi Gilhouley','email' => 'mgilhouley2@telegraph.co.uk','senha' => $senhaPadrao, 'telefone' => '(19) 966290104','estado' => 'SP','cidade' => 'Araraquara','data_nascimento' => '1984-09-13'],
            ['ativo' => true,'nome' => 'Lexy Sprulls','email' => 'lsprulls3@moonfruit.com','senha' => $senhaPadrao, 'telefone' => '(19) 976121601','estado' => 'SP','cidade' => 'Rio Claro','data_nascimento' => '1999-10-19'],
            ['ativo' => true,'nome' => 'Marie Shatliff','email' => 'mshatliff4@cbslocal.com','senha' => $senhaPadrao, 'telefone' => '(19) 991376354','estado' => 'SP','cidade' => 'Rio Claro','data_nascimento' => '1990-07-20'],
            ['ativo' => true,'nome' => 'Graig Mouncey','email' => 'gmouncey5@so-net.ne.jp','senha' => $senhaPadrao, 'telefone' => '(19) 941806149','estado' => 'SP','cidade' => 'Araraquara','data_nascimento' => '1990-03-27'],
            ['ativo' => true,'nome' => 'Laurice Liger','email' => 'lliger0@php.net','senha' => $senhaPadrao, 'telefone' => '(35) 971740954','estado' => 'MG','cidade' => 'Areado','data_nascimento' => '1992-10-25'],
            ['ativo' => true,'nome' => 'Kendrick Sooper','email' => 'ksooper1@slate.com','senha' => $senhaPadrao, 'telefone' => '(31) 944324086','estado' => 'MG','cidade' => 'Belo Horizonte','data_nascimento' => '1981-06-02'],
            ['ativo' => true,'nome' => 'Gordon Levington','email' => 'glevington2@hpost.com','senha' => $senhaPadrao, 'telefone' => '(31) 922405868','estado' => 'MG','cidade' => 'Belo Horizonte','data_nascimento' => '1993-11-25'],
            ['ativo' => true,'nome' => 'Noam Scolland','email' => 'nscolland3@mozilla.org','senha' => $senhaPadrao, 'telefone' => '(35) 996817669','estado' => 'MG','cidade' => 'Areado','data_nascimento' => '1999-12-31'],
            ['ativo' => true,'nome' => 'Lindon Skehens','email' => 'lskehens4@npr.org','senha' => $senhaPadrao, 'telefone' => '(35) 967671104','estado' => 'MG','cidade' => 'Areado','data_nascimento' => '1985-01-10'],
            ['ativo' => true,'nome' => 'Kimbra Rase','email' => 'krase5@topsy.com','senha' => $senhaPadrao, 'telefone' => '(35) 999428030','estado' => 'MG','cidade' => 'Areado','data_nascimento' => '1999-05-05'],
            ['ativo' => true,'nome' => 'Lorenzo Fisk','email' => 'lfisk6@businessweek.com','senha' => $senhaPadrao, 'telefone' => '(31) 912695467','estado' => 'MG','cidade' => 'Belo Horizonte','data_nascimento' => '1985-12-22'],
            ['ativo' => true,'nome' => 'Bourke Flavelle','email' => 'bflavelle7@fc2.com','senha' => $senhaPadrao, 'telefone' => '(35) 959386145','estado' => 'MG','cidade' => 'Itapeva','data_nascimento' => '1984-04-10'],
            ['ativo' => true,'nome' => 'Curran McSharry','email' => 'cmcsharry8@webeden.co.uk','senha' => $senhaPadrao, 'telefone' => '(35) 902916131','estado' => 'MG','cidade' => 'Itapeva','data_nascimento' => '1983-01-15'],
            ['ativo' => true,'nome' => 'Aveline Dowtry','email' => 'adowtry9@miibeian.gov.cn','senha' => $senhaPadrao, 'telefone' => '(31) 945227500','estado' => 'MG','cidade' => 'Belo Horizonte','data_nascimento' => '1994-12-23'],
            ['ativo' => true,'nome' => 'John Sebastian','email' => 'jsebastiana@cbslocal.com','senha' => $senhaPadrao, 'telefone' => '(31) 907366740','estado' => 'MG','cidade' => 'Belo Horizonte','data_nascimento' => '1998-04-06'],
            ['ativo' => true,'nome' => 'Reynolds Greenan','email' => 'rgreenanb@bloomberg.com','senha' => $senhaPadrao, 'telefone' => '(35) 923551410','estado' => 'MG','cidade' => 'Itapeva','data_nascimento' => '1985-07-19']
        ]);
    }
}
