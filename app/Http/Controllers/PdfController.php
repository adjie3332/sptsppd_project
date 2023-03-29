<?php

namespace App\Http\Controllers;
use App\Models\Sppd;
use App\Models\Spt;
use App\Models\Pegawai;
use App\Models\Biaya;
use App\Models\Instansi;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\SppdController;
use App\Http\Controllers\SptController;
use App\Http\Controllers\LaporanController;
use Attribute;
use League\CommonMark\Extension\Attributes\Node\Attributes;


class PDF_MC_Table extends FPDF
{
    var $widths;
    var $aligns;

    var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=(5*$nb)+5;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function TwoRow($data1, $data2)
    {
        //Calculate the height of the row
        $nb1 = 0;
        $nb2 = 0;

        for ($i = 0; $i < count($data1) && $i < count($data2); $i++) {
            $nb1 = max($nb1, $this->NbLines($this->widths[$i], $data1[$i]));
            $nb2 = max($nb2, $this->NbLines($this->widths[$i], $data2[$i]));
        }

        $h = (5 * ($nb1 + $nb2)) + 5;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i=0;$i<count($data1) && $i<count($data2) ;$i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h);
            $text1 = isset($data1[$i]) ? $data1[$i] : '';
            $text2 = isset($data2[$i]) ? $data2[$i] : '';
            $text = $text1 . "\n" . $text2;
            $this->MultiCell($w, 5, $text, 0, $a);
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function RowNoSpace($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=(5*$nb);
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function ThreeRow($data1, $data2, $data3)
    {
        //Calculate the height of the row
        $nb1 = 0;
        $nb2 = 0;
        $nb3 = 0;
        for ($i = 0; $i < count($data1) && $i < count($data2) && $i < count($data3) ; $i++) {
            $nb1 = max($nb1, $this->NbLines($this->widths[$i], $data1[$i]));
            $nb2 = max($nb2, $this->NbLines($this->widths[$i], $data2[$i]));
            $nb3 = max($nb3, $this->NbLines($this->widths[$i], $data3[$i]));
        }

        $h = (5 * ($nb1 + $nb2 + $nb3)) + 5;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data1) && $i < count($data2) && $i < count($data3) ; $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h);
            $text1 = isset($data1[$i]) ? $data1[$i] : '';
            $text2 = isset($data2[$i]) ? $data2[$i] : '';
            $text3 = isset($data3[$i]) ? $data3[$i] : '';
            $text = $text1 . "\n" . $text2 . "\n" . $text3;
            $this->MultiCell($w, 5, $text, 0, $a);
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function FourRow($data1, $data2, $data3, $data4)
    {
        //Calculate the height of the row
        $nb1 = 0;
        $nb2 = 0;
        $nb3 = 0;
        $nb4 = 0;
        for ($i = 0; $i < count($data1) && $i < count($data2) && $i < count($data3) && $i < count($data4) ; $i++) {
            $nb1 = max($nb1, $this->NbLines($this->widths[$i], $data1[$i]));
            $nb2 = max($nb2, $this->NbLines($this->widths[$i], $data2[$i]));
            $nb3 = max($nb3, $this->NbLines($this->widths[$i], $data3[$i]));
            $nb4 = max($nb4, $this->NbLines($this->widths[$i], $data4[$i]));
        }

        $h = 5 * ($nb1 + $nb2 + $nb3 + $nb4);
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data1) && $i < count($data2) && $i < count($data3) && $i < count($data4) ; $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h);
            $text1 = isset($data1[$i]) ? $data1[$i] : '';
            $text2 = isset($data2[$i]) ? $data2[$i] : '';
            $text3 = isset($data3[$i]) ? $data3[$i] : '';
            $text4 = isset($data4[$i]) ? $data4[$i] : '';
            $text = $text1 . "\n" . $text2 . "\n" . $text3 . "\n" . $text4;
            $this->MultiCell($w, 5, $text, 0, $a);
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Cell(0,5,$e,0,1,'C');
                else
                    $this->Write(5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    }

    function OpenTag($tag,$prop)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            $this->Ln(5);
        if($tag=='P')
            $this->ALIGN=$prop['ALIGN'];
        if($tag=='HR')
        {
            if( !empty($prop['WIDTH']) )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $this->Ln(2);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.4);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
    function displayEmptyInput($input)
    {
        if(empty($input)) {
            return '-';
        } else {
            return $input;
        }
    }

    function Kop()
    {
        $InstansiData = Instansi::get();
        // Kop
        $this->Image('images/boyolali-kop.png', 10, 7.5, 24, 26.7, 'PNG');
        $this->SetFont('Times', '', 16);
        $this->Cell(25, 7, "", 0, 0, "C");
        $this->Cell(0, 7, "PEMERINTAH KABUPATEN BOYOLALI", 0, 1, "C");
        $this->SetFont('Times', 'B', 18);
        $this->Cell(25, 7, "", 0, 0, "C");
        $this->Cell(0, 7, $InstansiData[0]->nama, 0, 1, "C");
        $this->SetFont('Times', '', 14);
        $this->Cell(25, 7, "", 0, 0, "C");
        $this->Cell(0, 7, "Komplek Perkantoran Terpadu Kabupaten Boyolali", 0, 1, "C");
        $this->SetFont('Times', '', 12);
        $this->Cell(25, 7, "", 0, 0, "C");
        $this->Cell(0, 5, "Alamat : " . $InstansiData[0]->alamat . "  Telepon " . $InstansiData[0]->telepon . "   Faks. " . $InstansiData[0]->faksimile, 0, 1, "C");
        $this->Cell(25, 7, "", 0, 0, "C");
        $this->Cell(0, 5, "Website : " . $InstansiData[0]->website . "   E-mail : " . $InstansiData[0]->email . "   Kode Pos " . $InstansiData[0]->kodepos, 0, 1, "C");
        // Garis
        $this->SetLineWidth(1);
        $this->Line(10, 43, 200, 43);
        $this->SetLineWidth(0);
        $this->Line(10, 42, 200, 42);
        $this->Ln(7);
    }


    function Dasar($dasar)
    {
        $this->SetFont('Times', '', 12);
        $this->Cell(30, 5, 'Dasar', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->MultiCell(0, 5, displayEmptyInput($dasar), 0);
        $this->Ln(1);
    }

    function Pegawai($listDiperintah)
    {
        if(count($listDiperintah) >= 4){
            $this->Cell(5, 5, "Terlampir", 0, 1);
            $this->Ln(10);
        }else{
            for($i=0; $i<= count($listDiperintah)-1; $i++){
                $number = $i+1;
                $this->Cell(5, 5, $number.".", 0, 0);
                $this->Cell(45, 5, 'Nama', 0, 0);
                $this->Cell(5, 5, ':', 0, 0);
                $this->MultiCell(0, 5, $listDiperintah[$i]->name, 0);

                $this->Cell(40, 5, "", 0, 0);
                $this->Cell(45, 5, 'Pangkat / Gol Ruang', 0, 0);
                $this->Cell(5, 5, ':', 0, 0);
                $this->MultiCell(0, 5, $listDiperintah[$i]->pangkat." / ".$listDiperintah[$i]->golongan, 0);

                $this->Cell(40, 5, "", 0, 0);
                $this->Cell(45, 5, 'NIP', 0, 0);
                $this->Cell(5, 5, ':', 0, 0);
                $this->MultiCell(0, 5, $listDiperintah[$i]->nip, 0);

                $this->Cell(40, 5, "", 0, 0);
                $this->Cell(45, 5, 'Jabatan', 0, 0);
                $this->Cell(5, 5, ':', 0, 0);
                $this->MultiCell(0, 5, $listDiperintah[$i]->jabatan, 0);
                $this->Ln(3);

                if($i != count($listDiperintah)-1)$this->Cell(35, 5, "", 0, 0);
            }
        }
    }


    function Untuk($untuk)
    {
        $this->Cell(30, 5, 'Untuk', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->MultiCell(0, 5, displayEmptyInput($untuk) , 0);
        $this->Cell(35, 5, '', 0, 0);
    }

    function Day_SPT($hari)
    {
        $this->Cell(50, 5, 'Hari', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->Cell(0, 5, $hari, 0, 1);
        $this->Cell(35, 5, '', 0, 0);
    }
    function Date_SPT($tanggal)
    {
        $this->Cell(50, 5, 'Tanggal', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->Cell(0, 5, $tanggal, 0, 1);
        $this->Cell(35, 5, '', 0, 0);
    }
    function Waktu_Tempat($waktu, $tempat)
    {
        $this->Cell(50, 5, 'Waktu', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->Cell(0, 6, $waktu, 0, 1);
        $this->Cell(35, 5, '', 0, 0);

        $this->Cell(50, 5, 'Tempat', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->MultiCell(0, 6, $tempat, 0);
        $this->Ln(5);
    }

    function Penetapan($tempat, $tanggal, $bu)
    {
        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(30, 5, "Ditetapkan di ".$tempat, 0, 1);
        // $this->Cell(5, 5, ":", 0, 0);
        // $this->Cell(5, 5, $tempat, 0, 1);

        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada tanggal ".$tanggal, 0, 1);
        // $this->Cell(5, 5, ":", 0, 0);
        // $this->Cell(30, 5, $tanggal, 0, 1);
        $this->Ln(3);
    }

    function Dikeluarkan($tanggal, $bu)
    {
        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(30, 5, "Dikeluarkan di "."Boyolali", 0, 1);
        // $this->Cell(5, 5, ":", 0, 0);
        // $this->Cell(5, 5, $tempat, 0, 1);

        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada tanggal ".$tanggal, 0, 1);
        // $this->Cell(5, 5, ":", 0, 0);
        // $this->Cell(30, 5, $tanggal, 0, 1);
        $this->Ln(3);
    }

    function Lembar($lembar, $kode, $nomor)
    {
        $this->SetFont('Times', '', 12);
        $this->Cell(100, 5, "", 0, 0);
        $this->Cell(25, 5, "Lembar ke", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 6, "$lembar", 0, 1);

        $this->Cell(100, 5, "", 0, 0);
        $this->Cell(25, 5, "Kode No", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 6, "$kode", 0, 1);

        $this->Cell(100, 5, "", 0, 0);
        $this->Cell(25, 5, "Nomor", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 6, "$nomor", 0, 1);
        $this->Ln(10);
    }

    function Tabel($id)
    {
        $this->SetWidths(Array(10, 65, 95)); // Total width 175
        $singleData = Sppd::find($id);
        $pemerintah = pegawai::find($singleData->pejabat_pemerintah);
        $Diperintah = pegawai::find($singleData->pejabat_diperintah);
        $pengikutlist = $singleData->pengikut()->get();
        $singlePengikut = $pengikutlist->map( function($p){
            return $p->name;
        });
        $singlenip = $pengikutlist->map( function($p){
            return $p->nip;
        });
        $a = array();
        for($i = 0; $i <= count($singlePengikut)-1; $i++){
            $number  = strval($i+1);
            if(count($singlePengikut) === 0){
                $g = "";
            }elseif(count($singlePengikut) === 1){
                $g = $singlePengikut[$i]. " / ". $singlenip[$i]."\n";
            }else{
                $g = $number.". ".$singlePengikut[$i]. " / ". $singlenip[$i]."\n";
            }
            array_push($a, $g);
        }
        $pengikut = implode("",$a);

        function ubahTanggalkeIndo($string){
            $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];

            $tanggal = explode("-", $string)[2];
            $bulan = explode("-", $string)[1];
            $tahun = explode("-", $string)[0];


            if($tanggal[0] == 0){
                $tgl =  $tanggal[1];
            }else{
                $tgl = $tanggal;
            }

            return $tgl . " " . $bulanIndo[abs($bulan)] . " " . $tahun;
        }
        function displayEmptyInput($input)
        {
            if(empty($input)) {
                return '-';
            } else {
                return $input;
            }
        }

        // function menghitungLamaPerjalanan($berangkat, $pulang){
        //     $tglBerangkat = explode("-", $berangkat)[2];
        //     $tglPulang = explode("-", $pulang)[2];

        //     $jeda = $tglPulang - $tglBerangkat;
        //     if($jeda == 1){
        //         return "1 hari";
        //     }else{
        //         $tgl = $jeda + 1;
        //         return $tgl. " hari";
        //     }
        // }

        function menghitungLamaPerjalanan($berangkat, $pulang){
            $tglBerangkat = explode("-", $berangkat)[2];
            $tglPulang = explode("-", $pulang)[2];

            $jeda = $tglPulang - $tglBerangkat;

            // menambahkan pengecekan jika perjalanan hanya berlangsung selama 1 hari
            if($jeda == 0){
                return "1 hari";
            // menambahkan pengecekan jika perjalanan berlangsung selama 2 hari
            }elseif($jeda == 1){
                return "2 hari";
            }else{
                $tgl = $jeda + 1;
                return $tgl. " hari";
            }
        }

        $this->Row(Array('1.', 'Pejabat yang memberi perintah', $pemerintah->jabatan));
        $this->Row(Array('2.', 'Nama / NIP Pegawai yang diperintah',  $Diperintah->name . " / " . $Diperintah->nip));
        $this->ThreeRow(Array('3.', 'a. Pangkat dan Golongan', $Diperintah->pangkat . " / ". $Diperintah->golongan), Array('', 'b. Jabatan'."\n", $Diperintah->jabatan), Array('', 'c. Tingkat Biaya Perjalanan Dinas', $Diperintah->eselon));
        $this->Row(Array('4.', 'Maksud Perjalanan', $singleData->maksud_perintah));
        $this->Row(Array('5.', 'Alat angkut yang dipergunakan', $singleData->transportasi));
        $this->TwoRow(Array('6.', 'a. Tempat berangkat', $singleData->tempat_berangkat), Array('', 'b. Tempat tujuan', $singleData->tempat_tujuan));
        $this->ThreeRow(Array('7.', 'a. Lamanya Perjalanan Dinas',menghitungLamaPerjalanan($singleData->tgl_pergi, $singleData->tgl_kembali)), Array('', 'b. Tanggal berangkat', ubahTanggalkeIndo($singleData->tgl_pergi)), Array('', 'c. Tanggal harus kembali', ubahTanggalkeIndo($singleData->tgl_kembali)));
        $this->Row(Array('8.', 'Pengikut / NIP', '-'));
        $this->ThreeRow(Array('9.', 'Pembebanan Anggaran', ''), Array('', 'a. Instansi', $singleData->instansi), Array('', 'b. Mata Anggaran', $singleData->mata_anggaran));
        $this->Row(Array('10.', 'Keterangan lain-lain', displayEmptyInput($singleData->keterangan)));
        $this->Ln(10);
    }

    function RomawiI($dari1, $tgl1, $ke1)
    {
        $this->Cell(83, 5, "", 0, 0);
        $this->Cell(7, 5, "I.", 0, 0);
        $this->Cell(30, 5, "Berangkat dari", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $dari1, 0, 0);
        $this->Ln(4);

        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(0, 6, "(tempat", 0, 1);

        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(30, 5, "kedudukan)", 0, 1);
        // $this->Cell(3, 5, ":", 0, 0);
        // $this->Cell(0, 6, $dari1 , 0, 1);

        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(30, 5, "Ke", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->MultiCell(0, 6, $ke1, 0, 1);

        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 5, $tgl1, 0, 0);
        $this->Ln(15);
    }

    function RomawiII($tiba1, $tgltiba1, $dari2, $ke2, $tgldari2)
    {
        $this->Cell(7, 5, "II.", 0, 0);
        $this->Cell(30, 5, "Tiba di", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(51, 5, $tiba1, 0, 0);
        $this->Cell(30, 5, "Berangkat dari", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $dari2, 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(51, 5, $tgltiba1, 0, 0);
        $this->Cell(30, 5, "Ke", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $ke2, 0, 1);

        $this->Cell(91, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $tgldari2, 0, 1);
        $this->Ln(15);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(85, 5, "(............................................................)", 0, 0);
        $this->Cell(0, 5, "(............................................................)", 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(85, 5, "NIP.", 0, 0);
        $this->Cell(0, 6, "NIP.", 0, 1);
        $this->Ln(5);
    }

    function RomawiIII($tiba, $tgltiba, $dari, $ke, $tgldari)
    {
        $this->Cell(7, 5, "III.", 0, 0);
        $this->Cell(30, 5, "Tiba di", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(51, 5, $tiba, 0, 0);
        $this->Cell(30, 5, "Berangkat dari", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $dari, 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(51, 5, $tgltiba, 0, 0);
        $this->Cell(30, 5, "Ke", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $ke, 0, 1);

        $this->Cell(91, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 5, $tgldari, 0, 1);
        $this->Ln(15);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(85, 5, "(............................................................)", 0, 0);
        $this->Cell(0, 6, "(............................................................)", 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(85, 5, "NIP.", 0, 0);
        $this->Cell(0, 6, "NIP.", 0, 1);
        $this->Ln(5);
    }

    function RomawiIV($tiba, $tgltiba, $dari, $ke, $tgldari)
    {
        $this->Cell(7, 5, "IV.", 0, 0);
        $this->Cell(30, 5, "Tiba di", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(51, 5, $tiba, 0, 0);
        $this->Cell(30, 5, "Berangkat dari", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $dari, 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(51, 5, $tgltiba, 0, 0);
        $this->Cell(30, 5, "Ke", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $ke, 0, 1);

        $this->Cell(91, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $tgldari, 0, 1);
        $this->Ln(15);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(85, 5, "(............................................................)", 0, 0);
        $this->Cell(0, 6, "(............................................................)", 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(85, 5, "NIP.", 0, 0);
        $this->Cell(0, 6, "NIP.", 0, 1);
    }

    function RomawiV($tiba, $tgl)
    {
        $this->Cell(1, 5, "", 0, 0);
        $this->Cell(7, 5, "V.", 0, 0);
        $this->Cell(30, 5, "Tiba kembali di", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $tiba, 0, 1);

        $this->Cell(8, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada tanggal", 0, 0);
        $this->Cell(3, 5, ":", 0, 0);
        $this->Cell(0, 6, $tgl, 0, 1);

        $this->Cell(8, 5, "", 0, 0);
        $this->MultiCell(0, 6, "Telah diperiksa, dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.", 0, 1);
        $this->Ln(5);
    }

    function Judul($kegiatan, $lokasi)
    {
        $this->SetFont('Times', '', 14);
        $this->Cell(0, 7, "PEMERINTAH KABUPATEN BOYOLALI", 0, 1, "C");
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 6, $kegiatan, 0, 1, "C");
        $this->Cell(0, 6, "Lokasi: ". $lokasi, 0, 1, "C");
        $this->Ln(5);
    }

    function Kegiatan($kegiatan, $rekening, $unitkerja)
    {
        $this->Cell(10, 5, "", 0, 0);
        $this->Cell(35, 5, "Kegiatan", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 6, $kegiatan, 0, 1);

        $this->Cell(10, 5, "", 0, 0);
        $this->Cell(35, 5, "Kode Rekening", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 6, $rekening, 0, 1);
        $this->Ln(5);

        $this->Cell(10, 5, "", 0, 0);
        $this->Cell(35, 5, "Unit Kerja", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 6, $unitkerja, 0, 1);
        $this->Ln(3);
    }

    function kepala_dinas($id)
    {
        $sah_kpl = Spt::find($id);
        $Menetapkan = pegawai::find($sah_kpl->yang_menetapkan);
        $this->SetFont('Times', '', 12);
        $this->Cell(30, 5, 'Nama', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->Cell(0, 5, $Menetapkan->name, 0, 1);

        $this->SetFont('Times', '', 12);
        $this->Cell(30, 5, 'NIP', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->Cell(0, 5, $Menetapkan->nip, 0, 1);

        $this->SetFont('Times', '', 12);
        $this->Cell(30, 5, 'Pangkat / Gol', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->Cell(0, 5, $Menetapkan->pangkat." / ".$Menetapkan->golongan, 0, 1);

        $this->SetFont('Times', '', 12);
        $this->Cell(30, 5, 'Jabatan', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->Cell(0, 5, $Menetapkan->jabatan, 0, 1);
        $this->Ln(5);
    }

    function TTD_SPT($id)
    {
        $ttd_kpl = Spt::find($id);
        $Menetapkan_ttd = pegawai::find($ttd_kpl->yang_menetapkan);
        $this->Cell(90, 5, "", 0, 0);
        // $this->Cell(7, 5, "Plt.", 0, 0);
        $this->Cell(0, 6, "KEPALA DINAS KETAHANAN PANGAN ", 0, 1);

        $this->Cell(105, 5, "", 0, 0);
        $this->Cell(0, 6, "KABUPATEN BOYOLALI", 0, 1);
        $this->Ln(15);


        $this->SetFont('Times', 'BU', 12);
        $this->Cell(100, 5, "", 0, 0);
        $this->Cell(0, 5, $Menetapkan_ttd->name, 0, 1);

        $this->Cell(110, 5, "", 0, 0);
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 5, $Menetapkan_ttd->pangkat, 0, 1);

        $this->Cell(105, 5, "", 0, 0);
        $this->Cell(0, 5, "NIP. ".$Menetapkan_ttd->nip, 0, 1);
    }

    function TTD_SPPD($id)
    {
        $ttd_kpl = Sppd::find($id);
        $Menetapkan_ttd = pegawai::find($ttd_kpl->pejabat_pemerintah);
        $this->Cell(92, 5, "", 0, 0);
        // $this->Cell(7, 5, "", 0, 0);
        $this->Cell(0, 5, "PENGGUNA ANGGARAN", 0, 1);

        // $this->Cell(90, 5, "", 0, 0);
        // $this->Cell(0, 5, "KABUPATEN BOYOLALI", 0, 1);
        $this->Ln(15);


        $this->SetFont('Times', 'BU', 12);
        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(0, 5, $Menetapkan_ttd->name, 0, 1);

        $this->Cell(95, 5, "", 0, 0);
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 5, $Menetapkan_ttd->pangkat, 0, 1);

        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(0, 5, "NIP. ".$Menetapkan_ttd->nip, 0, 1);
    }


    function TTDterlampir($bu){
        $this->Cell(62, 5, "", 0, 0);
        // $this->Cell(7, 5, "Plt.", 0, 0);
        $this->MultiCell(0, 5, "KEPALA DINAS KETAHANAN PANGAN KABUPATEN BOYOLALI", 0, 1);
        $this->Ln(20);

        $this->SetFont('Times', $bu, 12);
        $this->Cell(69, 5, "", 0, 0);
        $this->Cell(0, 5, "Ir. Joko Suhartono, M.Si.", 0, 1);

        $this->Cell(69, 5, "", 0, 0);
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 5, "Pembina Utama Muda", 0, 1);

        $this->Cell(69, 5, "", 0, 0);
        $this->Cell(0, 5, "NIP. 19650220 199302 1 002", 0, 1);
    }
}

class PdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new PDF_MC_Table();
    }

    // Surat Perintah Tugas
    public function pdf1($id)
    {
        $dataSpt = Spt::find($id);
        function convertDaytoIndo($tanggal1, $tanggal2) {
            $hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
            $day1 = date('w', strtotime($tanggal1));
            $day2 = date('w', strtotime($tanggal2));

            if ($day1 == $day2) {
              $hari_indo = $hari[$day1];
              $indo_day = array($hari_indo);
              return implode($indo_day);
            } else {
              $hari_indo1 = $hari[$day1];
              $indo_day1 = array($hari_indo1);
              $hari_indo2 = $hari[$day2];
              $indo_day2 = array($hari_indo2);
              return implode($indo_day1)." - ". implode($indo_day2);
            }
        }

        function DateIndo($string = null){
            // cek apakah nilai string tidak kosong
            if (!empty($string)) {
                $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];

                $tanggal = explode("-", $string)[2];
                $bulan = explode("-", $string)[1];
                $tahun = explode("-", $string)[0];

                if($tanggal[0] == 0){
                    $tgl =  $tanggal[1];
                } else {
                    $tgl = $tanggal;
                }

                return $tgl . " " . $bulanIndo[abs($bulan)] . " " . $tahun;
            } else {
                // jika tidak ada nilai string, kembalikan nilai kosong
                return '';
            }
        }
        function cek_tanggal($tgl1, $tgl2) {
            // Daftar nama bulan dalam bahasa Indonesia
            $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            // Ubah tanggal menjadi format tanggal dengan format 'Y-m-d'
            $str_tgl1 = date('Y-m-d', strtotime($tgl1));
            $str_tgl2 = date('Y-m-d', strtotime($tgl2));

            // Jika tanggal 1 dan tanggal 2 sama, tampilkan satu saja
            if ($str_tgl1 == $str_tgl2) {
                return date('j', strtotime($tgl1)) . ' ' . $bulanIndo[date('n', strtotime($tgl1))] . ' ' . date('Y', strtotime($tgl1));
            } else {
                return date('j', strtotime($tgl1)) . ' ' . $bulanIndo[date('n', strtotime($tgl1))] . ' ' . date('Y', strtotime($tgl1)) . ' - ' . date('j', strtotime($tgl2)) . ' ' . $bulanIndo[date('n', strtotime($tgl2))] . ' ' . date('Y', strtotime($tgl2));
            }
        }

        function membuatWaktu($waktu) {
            // Ubah waktu ke format 24 jam
            $waktu = date('H:i', strtotime($waktu));
            return $waktu;
        }

        // Memngecek apakah inputan kosong
        function displayEmptyInput($input)
        {
            if(empty($input)) {
                return '-';
            } else {
                return $input;
            }
        }

        $listDiperintah = $dataSpt->diperintah()->get();
        $this->fpdf->SetMargins(20, 7.5, 20);
        $this->fpdf->AddPage('P', array(210, 330));

        // Kop Surat dan Garis Dua
        $this->fpdf->Kop();

        // Judul Surat Perintah Tugas
        $this->fpdf->SetFont('Times', 'BU', 12);
        $this->fpdf->Cell(0, 5, "SURAT PERINTAH TUGAS", 0, 1, "C");
        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Cell(57, 5, "", 0, 0);
        $this->fpdf->Cell(0, 5, "Nomor : ".$dataSpt->nomor_surat, 0, 0);
        $this->fpdf->Ln(10);

        // Dasar
        $this->fpdf->Dasar($dataSpt->dasar_perintah);
        $this->fpdf->Ln(5);

        // Kepala Dinas
        $this->fpdf->kepala_dinas($id);

        // Memerintahkan
        $this->fpdf->SetFont('Times', 'B', 12);
        $this->fpdf->Cell(0, 5, "MEMERINTAHKAN :", 0, 1, "C");
        $this->fpdf->Ln(5);

        // Kepada
        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Cell(30, 5, 'Kepada', 0, 0);
        $this->fpdf->Cell(5, 5, ':', 0, 0);

        $this->fpdf->Pegawai($listDiperintah);

        // Untuk
        $this->fpdf->Untuk($dataSpt->maksud_tugas." pada:");

        // Hari
        $this->fpdf->Day_SPT(convertDaytoIndo($dataSpt->tgl_pergi, $dataSpt->tgl_kembali));

        // Tanggal
        $this->fpdf->Date_SPT(cek_tanggal($dataSpt->tgl_pergi, $dataSpt->tgl_kembali));

        // Waktu dan Tempat
        $this->fpdf->Waktu_Tempat($dataSpt->waktu." WIB s/d selesai", $dataSpt->tempat);

        // Dengan Ketentuan
        // $this->fpdf->Cell(0, 5, 'Dengan ketentuan : ', 0, 1);
        // $this->fpdf->MultiCell(0, 5, 'Setelah selesai melaksanakan tugas segera melaporkan hasil pelaksanaan tugas kepada atasan.', 0);

        $this->fpdf->Cell(180, 5, "Demikian Surat Perintah ini agar dilaksanakan dengan sebaik-baiknya dan penuh tanggung", 0, 1, "C");
        $this->fpdf->Cell(20, 5, "jawab.", 0, 1, "C");


        // Penetapan
        $this->fpdf->Penetapan( $dataSpt->tempat_ditetapkan,  DateIndo($dataSpt->tgl_ditetapkan), "BU");

        // Tanda Tangan
        $this->fpdf->TTD_SPT($id);

        if(count($listDiperintah) >= 4){
            $this->fpdf->AddPage('P', array(210, 330));

            $this->fpdf->SetFont('Times', '', 12);

            $this->fpdf->Ln(5);
            $this->fpdf->Cell(85, 5, "", 0, 0);
            $this->fpdf->Cell(0, 5, "Lampiran SPT/SPPD", 0, 1);
            $this->fpdf->Cell(85, 5, "", 0, 0);
            $this->fpdf->Cell(0, 5, "No.", 0, 0);
            $this->fpdf->Cell(85, 5, "", 0, 0);
            $this->fpdf->Cell(0, 5, "Tanggal :", 0, 0);
            $this->fpdf->Ln(10);

            $this->fpdf->SetFont('Times', '', 12);
            $this->fpdf->Cell(30, 5, 'Kepada', 0, 0);
            $this->fpdf->Cell(5, 5, ':', 0, 1);


            for($i=0; $i<= count($listDiperintah)-1; $i++){
                $number = $i+1;
                $this->fpdf->Cell(5, 5, $number.".", 0, 0);
                $this->fpdf->Cell(45, 5, 'Nama', 0, 0);
                $this->fpdf->Cell(5, 5, ':', 0, 0);
                $this->fpdf->Cell(0, 5, $listDiperintah[$i]->name, 0, 1);

                $this->fpdf->Cell(40, 5, "", 0, 0);
                $this->fpdf->Cell(45, 5, 'Pangkat / Gol Ruang', 0, 0);
                $this->fpdf->Cell(5, 5, ':', 0, 0);
                $this->fpdf->Cell(0, 5, $listDiperintah[$i]->pangkat." / ".$listDiperintah[$i]->golongan, 0, 0);

                $this->fpdf->Cell(40, 5, "", 0, 0);
                $this->fpdf->Cell(45, 5, 'NIP', 0, 0);
                $this->fpdf->Cell(5, 5, ':', 0, 0);
                $this->fpdf->Cell(0, 5, $listDiperintah[$i]->nip, 0, 0);

                $this->fpdf->Cell(40, 5, "", 0, 0);
                $this->fpdf->Cell(45, 5, 'Jabatan', 0, 0);
                $this->fpdf->Cell(5, 5, ':', 0, 0);
                $this->fpdf->Cell(0, 5, $listDiperintah[$i]->jabatan, 0, 0);
                $this->fpdf->Ln(5);

                if($i != count($listDiperintah)-1)$this->fpdf->Cell(35, 5, "", 0, 0);
            }
            $this->fpdf->Ln(10);
            $this->fpdf->TTDterlampir("BU");

        }

        $this->fpdf->Output('I', 'SPT.pdf');
        exit;
    }




    // Surat Permintaan Perjalanan Dinas
    public function pdf2($id)
    {
        $dataSppd = Sppd::find($id);
        $this->fpdf->SetMargins(20, 7.5, 20);
        $this->fpdf->AddPage('P', array(210, 330));

        function DateIndo($string = null){
            // cek apakah nilai string tidak kosong
            if (!empty($string)) {
                $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];

                $tanggal = explode("-", $string)[2];
                $bulan = explode("-", $string)[1];
                $tahun = explode("-", $string)[0];

                if($tanggal[0] == 0){
                    $tgl =  $tanggal[1];
                } else {
                    $tgl = $tanggal;
                }

                return $tgl . " " . $bulanIndo[abs($bulan)] . " " . $tahun;
            } else {
                // jika tidak ada nilai string, kembalikan nilai kosong
                return '';
            }
        }
        function checkParameters($param1, $param2) {
            if (isset($param1) && !isset($param2)) {
                return "DKP Kab. Boyolali";
            } else if (!isset($param1)&& (!isset($param2))) {
                return "";
            } else if (isset($param1)&& isset($param2)) {
                return $param2;
            }
        }

        // Kop Surat dan Garis Dua
        $this->fpdf->Kop();

        // Lembar ke
        $this->fpdf->Lembar('I / II / III/ IV', '06.09', $dataSppd->nomor_surat);

        // Surat Perintah Perjalanan Dinas
        $this->fpdf->SetFont('Times', 'BU', 14);
        $this->fpdf->Cell(0, 5, "SURAT PERINTAH PERJALANAN DINAS", 0, 1, "C");
        $this->fpdf->SetFont('Times', 'B', 14);
        $this->fpdf->Cell(0, 5, "(S P P D)", 0, 1, "C");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Times', '', 12);

        // Garis Dua
        // $this->fpdf->SetLineWidth(0);
        // $this->fpdf->Line(20, 77, 190, 77);
        // $this->fpdf->SetLineWidth(0);
        // $this->fpdf->Line(20, 78, 190, 78);
        // $this->fpdf->Ln(7);

        // Tabel
        $this->fpdf->Tabel($id);

        // Tanda Tangan
        $this->fpdf->Dikeluarkan(DateIndo($dataSppd->tgl_keluar), "BU");
        $this->fpdf->TTD_SPPD($id);

        // Halaman Tanda Tangan
        $this->fpdf->AddPage('P', array(210, 330));

        // Garis I
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 5, 190, 5);
        $this->fpdf->Line(20, 310, 20, 5);
        $this->fpdf->Line(103, 190, 103, 5);
        $this->fpdf->Line(190, 310, 190, 5);

        // Romawi I
        $this->fpdf->RomawiI( $dataSppd->tempat_berangkat , $dataSppd->tempat_tujuan_1 , dateIndo($dataSppd->tgl_pergi));

        // Garis II
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 40, 190, 40);

        // Romawi II
        $this->fpdf->RomawiII( $dataSppd->tempat_tujuan_1 , dateIndo($dataSppd->tgl_tiba_1), $dataSppd->tempat_tujuan_1, checkParameters($dataSppd->tgl_berangkat_dari_1, $dataSppd->tempat_tujuan_2), dateIndo($dataSppd->tgl_berangkat_dari_1));

        // Garis III
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 89, 190, 89);

        // Romawi III
        $this->fpdf->RomawiIII( $dataSppd->tempat_tujuan_2, dateIndo($dataSppd->tgl_tiba_2), $dataSppd->tempat_tujuan_2, checkParameters($dataSppd->tgl_berangkat_dari_2, $dataSppd->tempat_tujuan_3), dateIndo($dataSppd->tgl_berangkat_dari_2));

        // Garis IV
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 140, 190, 140);

        // Romawi IV
        $this->fpdf->RomawiIV($dataSppd->tempat_tujuan_3, dateIndo($dataSppd->tgl_tiba_3), $dataSppd->tempat_tujuan_3, checkParameters('sji', ''), dateIndo($dataSppd->tgl_berangkat_dari_3));

        // Garis V
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 190, 190, 190);
        $this->fpdf->Ln(5);

        // Romawi V
        $this->fpdf->RomawiV( $dataSppd->tempat_berangkat, dateIndo($dataSppd->tgl_kembali));

        // Tanda Tangan
        $this->fpdf->TTD_SPPD($id);
        $this->fpdf->Ln(10);


        // Garis VI
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 270, 190, 270);

        // Romawi VI
        $this->fpdf->Cell(7, 5, "VI.", 0, 0);
        $this->fpdf->Cell(0, 5, "CATATAN LAIN LAIN", 0, 1);
        $this->fpdf->Ln(5);

        // Garis VII
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 280, 190, 280);

        // Garis VIII
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 310, 190, 310);

        // Romawi VII
        $this->fpdf->Cell(7, 5, "VII.", 0, 0);
        $this->fpdf->Cell(0, 5, "PERHATIAN", 0, 1);
        $this->fpdf->Cell(7, 5, "", 0, 0);
        $this->fpdf->MultiCell(0, 5, "Pejabat yang berwenang menerbitkan SPPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba serta Bendaharawan bertanggung jawab berdasarkan peraturan-peraturan Keuangan  Negara apabila Negara mendapat rugi akibat kesalahan, kealpaannya.", 0, 1);

        $this->fpdf->Output('I', 'SPPD.pdf');

        exit;
    }

    // Laporan SPT
    public function printLaporanSpt($tgl_awal, $tgl_akhir, $lap_spt)
    {
        function dateIndo($date)
        {
            $date = date_create($date);
            return date_format($date, "d-m-Y");
        }
        // // Membuat template file PDF dengan FPDF
        $this->fpdf = new PDF_MC_Table();

        // Header
        $this->fpdf->AddPage();
        $this->fpdf->Kop();
        $this->fpdf->SetFont('Times','B',12);
        $this->fpdf->Cell(0, 5, "LAPORAN DATA SPT", 0, 1, "C");
        $this->fpdf->Ln();

        // Tabel
        $this->fpdf->SetFont('Times','B',10);
        $this->fpdf->SetFillColor(255, 255, 255);
        $this->fpdf->Cell(0, 5, "Periode : ".dateIndo($tgl_awal)." s/d ".dateIndo($tgl_akhir), 0, 1, "L");
        $this->fpdf->SetWidths(array(8, 20, 30, 30, 40, 20, 20, 22));
        $this->fpdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $this->fpdf->RowNoSpace(Array('No', 'Tanggal Ditetapkan', 'Nomor Surat', 'Pegawai yang Diperintah', 'Maksud Tugas', 'Tanggal Pergi', 'Tanggal Kembali', 'Tempat'));

        $this->fpdf->setFont('Times','',10);
        foreach ($lap_spt as $key => $s) {
            $pegawai = array();
            for ($i = 0; $i < count($s->diperintah); $i++) {
                $pegawai[] = $s->diperintah[$i]->name;
            }
            $this->fpdf->Row(Array(
                $key+1,
                dateIndo($s->tgl_ditetapkan),
                $s->nomor_surat,
                ($key+1) .'. '. implode(", ", $pegawai),
                $s->maksud_tugas,
                dateIndo($s->tgl_pergi),
                dateIndo($s->tgl_kembali),
                $s->tempat,
            ));
        }

        // Output Print
        $this->fpdf->Output('I', 'Laporan Data SPT.pdf');
        exit;
    }

    // Laporan SPPD
    public function printLaporanSppd($tgl_awal, $tgl_akhir, $lap_sppd)
    {
        function dateIndo($date)
        {
            $date = date_create($date);
            return date_format($date, "d-m-Y");
        }

        // Menambahkan teks dan cell pada file PDF
        $this->fpdf->AddPage();
        $this->fpdf->Kop();
        $this->fpdf->SetFont('Times','B',12);
        $this->fpdf->Cell(0, 5, "LAPORAN DATA SPPD", 0, 1, "C");
        $this->fpdf->Ln();

        // Tabel
        $this->fpdf->SetFont('Times','B',10);
        $this->fpdf->Cell(0, 5, "Periode : ".dateIndo($tgl_awal)." s/d ".dateIndo($tgl_akhir), 0, 1, "L");
        $this->fpdf->SetWidths(array(8, 22, 30, 30, 40, 20, 20, 20));
        $this->fpdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $this->fpdf->RowNoSpace(Array('No', 'Tanggal Dikeluarkan', 'Nomor Surat', 'Pegawai yang Diperintah', 'Maksud Perjalanan Dinas', 'Tanggal Pergi', 'Tanggal Kembali', 'Tempat'));

        $this->fpdf->setFont('Times','',10);
        foreach ($lap_sppd as $key => $s) {
        $this->fpdf->Row(Array(
            $key+1,
            dateIndo($s->tgl_keluar),
            $s->nomor_surat,
            $s->pejabat_diperintahh->name,
            $s->maksud_perintah,
            dateIndo($s->tgl_pergi),
            dateIndo($s->tgl_kembali),
            $s->tempat_tujuan,
        ));
        }




        $this->fpdf->Output('I', 'Laporan Data SPPD.pdf');
        exit;
    }
}

