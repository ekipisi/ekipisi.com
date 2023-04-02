<?php
namespace App\Admin\Extensions\Exporter;

use Ekipisi\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class Partnership extends AbstractExporter
{
    public function export()
    {
        Excel::create('Gelir Ortakligi', function ($excel) {

            $excel->setTitle('Gelir Ortakligi')
                  ->setCreator('Ekipisi Yazilim ve Danimanlik Hizmetleri')
                  ->setCompany('Ekipisi Yazilim ve Danimanlik Hizmetleri')
                  ->setDescription('Gelir Ortakligi Listesi')
                  ->setSubject('Gelir Ortakligi Listesi');

            $excel->sheet('Referans Listesi', function ($sheet) {

                //Sütun genişliğini ayarlıyoruz
                $sheet->setWidth(array(
                    'A' =>  4,
                    'B' =>  10,
                    'C' =>  10,
                    'D' =>  20,
                    'E' =>  16,
                    'F' =>  13,
                    'G' =>  10,
                    'H' =>  10,
                    'I' =>  13,
                    'J' =>  13,
                    'K' =>  10,
                    'L' =>  10,
                    'M' =>  18,
                    'N' =>  18
                ));
                //Veri formatını düzenliyoruz
                $sheet->setColumnFormat(array(
                    'E' =>  '@',
                    'K' =>  '"₺"#,##0.00_-'
                ));
                //Başlıkları tanımlıyoruz
                $sheet->row(1, array(
                    'ID', 
                    'Ad', 
                    'Soyad',
                    'E-posta',
                    'Telefon',
                    'Firma Adı',
                    'Mesaj',
                    'Durum',
                    'Arandı mı?',
                    'Ödendi mi?',
                    'Ücret',
                    'Not',
                    'Ödeme Tarihi',
                    'Eklenme Tarihi'
                ));

                //Başlık formatını ayarlıyoruz
                $sheet->row(1, function($row) {
                    $row->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '16',
                        'bold'       =>  true
                    ));
                });

                //Verileri ekliyoruz.
                $rows = collect($this->getData())->map(function ($item) {
                    return array_only($item, [
                        'id', 
                        'firstname', 
                        'lastname', 
                        'email', 
                        'phone', 
                        'company', 
                        'message', 
                        'status', 
                        'called', 
                        'paid', 
                        'price', 
                        'note', 
                        'paid_at', 
                        'created_at']);
                });
                $sheet->rows($rows);

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  15,
                        'bold'      =>  false
                    )
                ));

                $sheet->setPageMargin(0.25);
                $sheet->freezeFirstRow();
                $sheet->setAutoFilter();
            });
        })->export('xlsx');


    }
}