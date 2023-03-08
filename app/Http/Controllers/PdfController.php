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
        $h=5*$nb;
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

    function Kop()
    {
        $InstansiData = Instansi::get();
        // Kop
        $this->Image('images/boyolali-kop.png', 10, 7.5, 24, 26.7, 'PNG');
        $this->SetFont('Times', 'B', 14);
        $this->Cell(25, 7, "", 0, 0, "C");
        $this->Cell(0, 7, "PEMERINTAH KABUPATEN BOYOLALI", 0, 1, "C");
        $this->SetFont('Times', 'B', 18);
        $this->Cell(25, 7, "", 0, 0, "C");
        $this->Cell(0, 7, $InstansiData[0]->nama, 0, 1, "C");
        // $this->SetFont('Times', '', 12);
        // $this->Cell(25, 7, "", 0, 0, "C");
        // $this->Cell(0, 7, "Komplek Perkantoran Terpadu Kabupaten Boyolali", 0, 1, "C");
        $this->SetFont('Times', '', 10);
        $this->Cell(25, 7, "", 0, 0, "C");
        $this->Cell(0, 5,"Alamat : ".$InstansiData[0]->alamat."  Telepon ".$InstansiData[0]->telepon."   Faks. ".$InstansiData[0]->faksimile, 0, 1, "C");
        $this->Cell(25, 7, "", 0, 0, "C");
        $this->Cell(0, 5,"Website : ".$InstansiData[0]->website."   E-mail : ".$InstansiData[0]->email."   Kode Pos ".$InstansiData[0]->kodepos, 0, 1, "C");
        // Garis
        $this->SetLineWidth(1);
        $this->Line(10, 35, 200, 35);
        $this->SetLineWidth(0);
        $this->Line(10, 36, 200, 36);
        $this->Ln(7);
    }

    function Dasar($dasar)
    {
        $this->Cell(30, 5, 'Dasar', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->MultiCell(0, 5, $dasar, 0);
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
                $this->Cell(0, 5, $listDiperintah[$i]->name, 0, 1);

                $this->Cell(40, 5, "", 0, 0);
                $this->Cell(45, 5, 'Pangkat / Gol Ruang', 0, 0);
                $this->Cell(5, 5, ':', 0, 0);
                $this->Cell(0, 5, $listDiperintah[$i]->pangkat." / ".$listDiperintah[$i]->golongan, 0, 1);
        
                $this->Cell(40, 5, "", 0, 0);
                $this->Cell(45, 5, 'NIP', 0, 0);
                $this->Cell(5, 5, ':', 0, 0);
                $this->Cell(0, 5, $listDiperintah[$i]->nip, 0, 1);
        
                $this->Cell(40, 5, "", 0, 0);
                $this->Cell(45, 5, 'Jabatan', 0, 0);
                $this->Cell(5, 5, ':', 0, 0);
                $this->Cell(0, 5, $listDiperintah[$i]->jabatan, 0, 1);
                $this->Ln(5);
    
                if($i != count($listDiperintah)-1)$this->Cell(35, 5, "", 0, 0);
            }
        }
    }
    

    function Untuk($untuk, $tanggal, $waktu, $tempat)
    {
        $this->Cell(30, 5, 'Untuk', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->MultiCell(0, 5, $untuk, 0);
        $this->Cell(35, 5, '', 0, 0);

        $this->Cell(50, 5, 'Hari / Tanggal', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->Cell(0, 5, $tanggal, 0, 1);
        $this->Cell(35, 5, '', 0, 0);

        $this->Cell(50, 5, 'Waktu', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->Cell(0, 5, $waktu, 0, 1);
        $this->Cell(35, 5, '', 0, 0);

        $this->Cell(50, 5, 'Tempat', 0, 0);
        $this->Cell(5, 5, ':', 0, 0);
        $this->MultiCell(0, 5, $tempat, 0);
        $this->Ln(5);
    }

    function TTD($tempat, $tanggal, $bu)
    {
        $this->Cell(76, 5, "", 0, 0);
        $this->Cell(30, 5, "Ditetapkan di ".$tempat, 0, 1);
        // $this->Cell(5, 5, ":", 0, 0);
        // $this->Cell(5, 5, $tempat, 0, 1);
        
        $this->Cell(76, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada tanggal ".$tanggal, 0, 1);
        // $this->Cell(5, 5, ":", 0, 0);
        // $this->Cell(30, 5, $tanggal, 0, 1);
        $this->Ln(3);

        $this->Cell(76, 5, "", 0, 0);
        // $this->Cell(7, 5, "Plt.", 0, 0);
        $this->Cell(0, 5, "KEPALA DINAS KETAHANAN PANGAN ", 0, 1);

        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(0, 5, "KABUPATEN BOYOLALI", 0, 1);
        $this->Ln(20);


        $this->SetFont('Times', $bu, 12);
        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(0, 5, "Ir. JOKO SUHARTONO, M.Si.", 0, 1);

        $this->Cell(95, 5, "", 0, 0);
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 5, "Pembina Utama Muda", 0, 1);

        $this->Cell(90, 5, "", 0, 0);
        $this->Cell(0, 5, "NIP. 19650220 199302 1 002", 0, 1);

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

    function Lembar($lembar, $kode, $nomor)
    {
        $this->SetFont('Times', '', 12);
        $this->Cell(100, 5, "", 0, 0);
        $this->Cell(25, 5, "Lembar ke", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 5, "$lembar", 0, 1);
        
        $this->Cell(100, 5, "", 0, 0);
        $this->Cell(25, 5, "Kode No", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 5, "$kode", 0, 1);
        
        $this->Cell(100, 5, "", 0, 0);
        $this->Cell(25, 5, "Nomor", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 5, "$nomor", 0, 1);
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
        function menghitungLamaPerjalanan($berangkat, $pulang){
            $tglBerangkat = explode("-", $berangkat)[2];
            $tglPulang = explode("-", $pulang)[2];

            $jeda = $tglPulang - $tglBerangkat;
            if($jeda == 1){
                return "1 hari";
            }else{
                $tgl = $jeda + 1;
                return $tgl. " hari";
            }
        }
        $this->Row(array('1.', 'Pejabat yang memberi perintah', $pemerintah->name));
        $this->Row(array('2.', 'Nama / NIP Pegawai yang diperintah',  $Diperintah->name . " / " . $Diperintah->nip));
        $this->Row(array('3.', 'a. Pangkat dan Golongan', $Diperintah->pangkat));
        $this->Row(array('', 'b. Jabatan', $Diperintah->jabatan));
        $this->Row(array('', 'c. Tingkat Biaya menurut peraturan perjalanan', $Diperintah->golongan));
        $this->Row(array('4.', 'Maksud Perjalanan', $singleData->maksud_perintah));
        $this->Row(array('5.', 'Alat angkut yang dipergunakan', $singleData->transportasi));
        $this->Row(array('6.', 'a. Tempat berangkat', $singleData->tempat_berangkat));
        $this->Row(array('', 'b. Tempat tujuan', $singleData->tempat_tujuan));
        $this->Row(array('7.', 'a. Lamanya Perjalanan Dinas', menghitungLamaPerjalanan($singleData->tgl_pergi, $singleData->tgl_kembali)));
        $this->Row(array('', 'b. Tanggal berangkat', ubahTanggalkeIndo($singleData->tgl_pergi)));
        $this->Row(array('', 'c. Tanggal harus kembali', ubahTanggalkeIndo($singleData->tgl_kembali)));
        $this->Row(array('8.', 'Pengikut / NIP', $pengikut));
        $this->Row(array('9.', 'Pembebanan Anggaran', ''));
        $this->Row(array('', 'a. Instansi', $singleData->instansi));
        $this->Row(array('', 'b. Mata Anggaran', $singleData->mata_anggaran));
        $this->Row(array('10.', 'Keterangan lain-lain', $singleData->keterangan));
        $this->Ln(10);
    }

    function RomawiI($no, $dari, $tgl, $ke)
    {
        $this->Cell(88, 5, "", 0, 0);
        $this->Cell(7, 5, "I.", 0, 0);
        $this->Cell(30, 5, "Berangkat dari", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $dari, 0, 1);

        $this->Cell(95, 5, "", 0, 0);
        $this->Cell(30, 5, "Ke", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $ke, 0, 1);

        $this->Cell(95, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $tgl, 0, 1);
        $this->Ln(15);
    }

    function RomawiII($tiba, $tgltiba, $dari, $ke, $tgldari)
    {
        $this->Cell(7, 5, "II.", 0, 0);
        $this->Cell(30, 5, "Tiba di", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(51, 5, $tiba, 0, 0);
        $this->Cell(30, 5, "Berangkat dari", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $dari, 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(51, 5, $tgltiba, 0, 0);
        $this->Cell(30, 5, "Ke", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $ke, 0, 1);

        $this->Cell(95, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $tgldari, 0, 1);
        $this->Ln(15);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(88, 5, "(............................................................)", 0, 0);
        $this->Cell(0, 5, "(............................................................)", 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(88, 5, "NIP.", 0, 0);
        $this->Cell(0, 5, "NIP.", 0, 1);
        $this->Ln(5);
    }

    function RomawiIII($tiba, $tgltiba, $dari, $ke, $tgldari)
    {
        $this->Cell(7, 5, "III.", 0, 0);
        $this->Cell(30, 5, "Tiba di", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(51, 5, $tiba, 0, 0);
        $this->Cell(30, 5, "Berangkat dari", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $dari, 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(51, 5, $tgltiba, 0, 0);
        $this->Cell(30, 5, "Ke", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $ke, 0, 1);

        $this->Cell(95, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $tgldari, 0, 1);
        $this->Ln(15);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(88, 5, "(............................................................)", 0, 0);
        $this->Cell(0, 5, "(............................................................)", 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(88, 5, "NIP.", 0, 0);
        $this->Cell(0, 5, "NIP.", 0, 1);
        $this->Ln(5);
    }

    function RomawiIV($tiba, $tgltiba, $dari, $ke, $tgldari)
    {
        $this->Cell(7, 5, "IV.", 0, 0);
        $this->Cell(30, 5, "Tiba di", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(51, 5, $tiba, 0, 0);
        $this->Cell(30, 5, "Berangkat dari", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $dari, 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(51, 5, $tgltiba, 0, 0);
        $this->Cell(30, 5, "Ke", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $ke, 0, 1);

        $this->Cell(95, 5, "", 0, 0);
        $this->Cell(30, 5, "Pada Tanggal", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $tgldari, 0, 1);
        $this->Ln(15);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(88, 5, "(............................................................)", 0, 0);
        $this->Cell(0, 5, "(............................................................)", 0, 1);

        $this->Cell(7, 5, "", 0, 0);
        $this->Cell(88, 5, "NIP.", 0, 0);
        $this->Cell(0, 5, "NIP.", 0, 1);
    }

    function RomawiV($tiba, $tgl)
    {
        $this->Cell(5, 5, "", 0, 0);
        $this->Cell(7, 5, "V.", 0, 0);
        $this->Cell(43, 5, "Tiba kembali di", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $tiba, 0, 1);

        $this->Cell(13, 5, "", 0, 0);
        $this->Cell(43, 5, "Pada tanggal", 0, 0);
        $this->Cell(7, 5, ":", 0, 0);
        $this->Cell(0, 5, $tgl, 0, 1);

        $this->Cell(13, 5, "", 0, 0);
        $this->MultiCell(0, 5, "Telah diperiksa, dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.", 0, 1);
        $this->Ln(10);
    }

    function Judul($kegiatan, $lokasi)
    {
        $this->SetFont('Times', '', 14);
        $this->Cell(0, 7, "PEMERINTAH KABUPATEN BOYOLALI", 0, 1, "C");
        $this->SetFont('Times', '', 12);
        $this->Cell(0, 5, $kegiatan, 0, 1, "C");
        $this->Cell(0, 5, "Lokasi: " . $lokasi, 0, 1, "C");
        $this->Ln(5);
    }

    function Kegiatan($kegiatan, $rekening, $unitkerja)
    {
        $this->Cell(10, 5, "", 0, 0);
        $this->Cell(35, 5, "Kegiatan", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 5, $kegiatan, 0, 1);

        $this->Cell(10, 5, "", 0, 0);
        $this->Cell(35, 5, "Kode Rekening", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 5, $rekening, 0, 1);
        $this->Ln(5);

        $this->Cell(10, 5, "", 0, 0);
        $this->Cell(35, 5, "Unit Kerja", 0, 0);
        $this->Cell(5, 5, ":", 0, 0);
        $this->Cell(0, 5, $unitkerja, 0, 1);
        $this->Ln(3);
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
        function convertDateDBtoIndo($string){
            // contoh : 2019-01-30
            $timestamp = strtotime($string);
            $day = date('l', $timestamp);
            switch ($day) {
                case 'Sunday':
                 $hari = 'Minggu';
                 break;
                case 'Monday':
                 $hari = 'Senin';
                 break;
                case 'Tuesday':
                 $hari = 'Selasa';
                 break;
                case 'Wednesday':
                 $hari = 'Rabu';
                 break;
                case 'Thursday':
                 $hari = 'Kamis';
                 break;
                case 'Friday':
                 $hari = 'Jum\'at';
                 break;
                case 'Saturday':
                 $hari = 'Sabtu';
                 break;
                default:
                 $hari = 'Tidak ada';
                 break;
               }
            
            $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];
         
            $tanggal = explode("-", $string)[2];
            $bulan = explode("-", $string)[1];
            $tahun = explode("-", $string)[0];

            if($tanggal[0] == 0){
                $tgl =  $tanggal[1];
            }else{
                $tgl = $tanggal;
            }
           
            return $hari. ', '. $tgl . " " . $bulanIndo[abs($bulan)] . " " . $tahun;
        }
        function DateIndo($string){
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
        // function membuatWaktu($waktu){
        //     $jam = explode(":", $waktu)[0];
        //     $menit = explode(":", $waktu)[1];

        //     return $jam.".".$menit;
        // }
        function membuatWaktu($waktu) {
            // Ubah waktu ke format 24 jam
            $waktu = date('H:i', strtotime($waktu));
        
            // Ubah zona waktu ke Asia/Jakarta
            // $timezone = new DateTimeZone('Asia/Jakarta');
            // $waktu = new DateTime($waktu, $timezone);
        
            // Ubah format waktu menjadi string
            // $waktu = $waktu->format('H:i');
        
            return $waktu;
        }

        $listDiperintah = $dataSpt->diperintah()->get();
        $this->fpdf->SetMargins(20, 7.5, 20);
        $this->fpdf->AddPage('P', array(210, 330));

        // Kop Surat dan Garis Dua
        $this->fpdf->Kop();

        // Judul Surat Perintah Tugas
        $this->fpdf->SetFont('Times', 'BU', 12);
        $this->fpdf->Cell(0, 7, "SURAT PERINTAH TUGAS", 0, 1, "C");
        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Cell(57, 7, "", 0, 0);
        $this->fpdf->Cell(0, 7, "Nomor : ".$dataSpt->nomor_surat, 0, 0);
        $this->fpdf->Ln(15);

        // Dasar
        $this->fpdf->Dasar($dataSpt->dasar_perintah);
        $this->fpdf->Ln(5);

        // Kepala Dinas
        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Cell(30, 5, 'Nama', 0, 0);
        $this->fpdf->Cell(5, 5, ':', 0, 0);
        $this->fpdf->Cell(0, 5, "Ir. Joko Suhartono, M.Si", 0, 1);

        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Cell(30, 5, 'NIP', 0, 0);
        $this->fpdf->Cell(5, 5, ':', 0, 0);
        $this->fpdf->Cell(0, 5, "19650220 199302 1 002", 0, 1);

        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Cell(30, 5, 'Pangkat / Gol', 0, 0);
        $this->fpdf->Cell(5, 5, ':', 0, 0);
        $this->fpdf->Cell(0, 5, "Pembina Utama Muda / IVc", 0, 1);

        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Cell(30, 5, 'Jabatan', 0, 0);
        $this->fpdf->Cell(5, 5, ':', 0, 0);
        $this->fpdf->Cell(0, 5, "Kepala Dinas Ketahanan Pangan Kabupaten Boyolali", 0, 1);
        $this->fpdf->Ln(7);

        // Memerintahkan
        $this->fpdf->SetFont('Times', 'B', 12);
        $this->fpdf->Cell(0, 5, "MEMERINTAHKAN :", 0, 1, "C");
        $this->fpdf->Ln(10);

        // Kepada
        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Cell(30, 5, 'Kepada', 0, 0);
        $this->fpdf->Cell(5, 5, ':', 0, 0);

        $this->fpdf->Pegawai($listDiperintah);

        // Untuk
        $this->fpdf->Untuk($dataSpt->maksud_tugas." pada:", convertDateDBtoIndo($dataSpt->hari_tgl) , membuatWaktu($dataSpt->waktu)." WIB s/d selesai", $dataSpt->tempat);

        // Dengan Ketentuan
        // $this->fpdf->Cell(0, 5, 'Dengan ketentuan : ', 0, 1);
        // $this->fpdf->MultiCell(0, 5, 'Setelah selesai melaksanakan tugas segera melaporkan hasil pelaksanaan tugas kepada atasan.', 0);

        $this->fpdf->Cell(180, 5, "Demikian Surat Perintah ini agar dilaksanakan dengan sebaik-baiknya dan penuh tanggung", 0, 1, "C");
        $this->fpdf->Cell(20, 5, "jawab.", 0, 1, "C");

        // Tanda Tangan
        $this->fpdf->TTD( $dataSpt->tempat_ditetapkan,  DateIndo($dataSpt->tgl_ditetapkan), "BU");

        if(count($listDiperintah) >= 4){
            $this->fpdf->AddPage('P', array(210, 330));

            $this->fpdf->SetFont('Times', '', 12);

            $this->fpdf->Ln(5);
            $this->fpdf->Cell(85, 5, "", 0, 0);
            $this->fpdf->Cell(0, 5, "Lampiran SPT/SPPD", 0, 1);
            $this->fpdf->Cell(85, 5, "", 0, 0);
            $this->fpdf->Cell(0, 5, "No.", 0, 1);
            $this->fpdf->Cell(85, 5, "", 0, 0);
            $this->fpdf->Cell(0, 5, "Tanggal :", 0, 1);
            $this->fpdf->Ln(10);

            $this->fpdf->SetFont('Times', '', 12);
            $this->fpdf->Cell(30, 5, 'Kepada', 0, 0);
            $this->fpdf->Cell(5, 5, ':', 0, 0);

            for($i=0; $i<= count($listDiperintah)-1; $i++){
                $number = $i+1;
                $this->fpdf->Cell(5, 5, $number.".", 0, 0);
                $this->fpdf->Cell(45, 5, 'Nama', 0, 0);
                $this->fpdf->Cell(5, 5, ':', 0, 0);
                $this->fpdf->Cell(0, 5, $listDiperintah[$i]->name, 0, 1);
        
                $this->fpdf->Cell(40, 5, "", 0, 0);
                $this->fpdf->Cell(45, 5, 'Pangkat / Gol Ruang', 0, 0);
                $this->fpdf->Cell(5, 5, ':', 0, 0);
                $this->fpdf->Cell(0, 5, $listDiperintah[$i]->pangkat." / ".$listDiperintah[$i]->golongan, 0, 1);
        
                $this->fpdf->Cell(40, 5, "", 0, 0);
                $this->fpdf->Cell(45, 5, 'NIP', 0, 0);
                $this->fpdf->Cell(5, 5, ':', 0, 0);
                $this->fpdf->Cell(0, 5, $listDiperintah[$i]->nip, 0, 1);
        
                $this->fpdf->Cell(40, 5, "", 0, 0);
                $this->fpdf->Cell(45, 5, 'Jabatan', 0, 0);
                $this->fpdf->Cell(5, 5, ':', 0, 0);
                $this->fpdf->Cell(0, 5, $listDiperintah[$i]->jabatan, 0, 1);
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
        $this->fpdf->SetMargins(20, 7.5, 20);
        $this->fpdf->AddPage('P', array(210, 330));

        // Kop Surat dan Garis Dua
        $this->fpdf->Kop();

        // Lembar ke
        $this->fpdf->Lembar('......................', '......................', '......................');

        // Surat Perintah Perjalanan Dinas
        $this->fpdf->SetFont('Times', 'BU', 12);
        $this->fpdf->Cell(0, 5, "SURAT PERINTAH PERJALANAN DINAS", 0, 1, "C");
        $this->fpdf->SetFont('Times', 'B', 12);
        $this->fpdf->Cell(0, 5, "(S P P D)", 0, 1, "C");
        $this->fpdf->Ln(5);
        $this->fpdf->SetFont('Times', '', 12);
        // Tabel
        $this->fpdf->Tabel($id);

        // Tanda Tangan
        $this->fpdf->TTD("Boyolali", "13 Maret 2023", "U");

        // Halaman Tanda Tangan
        $this->fpdf->AddPage('P', array(210, 330));

        // Garis 1
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 5, 20, 310);
        // Garis 2
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(106, 5, 106, 172);

        // Garis 3
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(190, 5, 190, 310);

        // Garis 4
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 310, 190, 310);

        // Garis
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 5, 190, 5);
        // Romawi I
        $this->fpdf->RomawiI("...............................", "Kab. Karanganyar", "13 Juni 2022", "Kab. Bantul");

        // Garis
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 35, 190, 35);
        // Romawi II
        $this->fpdf->RomawiII("Kab. Bantul", "13 Juni 2022", "Kab. Bantul", "Kab. Gunung Kidul", "13 Juni 2022");

        // Garis
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 80, 190, 80);
        // Romawi III
        $this->fpdf->RomawiIII("Kab. Gunung Kidul", "14 Juni 2022", "Kab. Gunung Kidul", "Kab. Karanganyar", "14 Juni 2022");

        // Garis
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 125, 190, 125);
        // Romawi IV
        $this->fpdf->RomawiIV("", "", "", "", "");

        // Garis
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 172, 190, 172);
        $this->fpdf->Ln(10);

        // Romawi V
        $this->fpdf->RomawiV("", "");

        // Tanda Tangan
        $this->fpdf->Cell(77, 5, "", 0, 0);
        $this->fpdf->MultiCell(0, 5, 'KEPALA DINAS KETAHANAN PANAGAN ', 0, 1);

        $this->fpdf->Cell(90, 5, "", 0, 0);
        $this->fpdf->MultiCell(0, 5, 'KABUPATEN BOYOLALI', 0, 1);
        $this->fpdf->Cell(20, 5, ".", 0, 1, "C");
        $this->fpdf->Ln(20);

        $this->fpdf->Cell(90, 5, '', 0, 0);
        $this->fpdf->SetFont('Times', 'BU', 12);
        $this->fpdf->Cell(0, 5, 'Ir. JOKO SUHARTONO, M.Si.', 0, 1);

        $this->fpdf->Cell(99, 5, '', 0, 0);
        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Cell(0, 5, 'Pembina Utama Muda', 0, 1);

        $this->fpdf->Cell(95, 5, '', 0, 0);
        $this->fpdf->Cell(0, 5, 'NIP. 19650220 199302 1 002', 0, 1);
        $this->fpdf->Ln(10);


        // Garis
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 270, 190, 270);
        // Romawi VI
        $this->fpdf->Cell(7, 5, "VI.", 0, 0);
        $this->fpdf->Cell(0, 5, "CATATAN LAIN LAIN", 0, 1);
        $this->fpdf->Ln(5);

        // Garis
        $this->fpdf->SetLineWidth(0);
        $this->fpdf->Line(20, 282, 190, 282);

        // Romawi VII
        $this->fpdf->Cell(7, 5, "VII.", 0, 0);
        $this->fpdf->Cell(0, 5, "PERHATIAN", 0, 1);
        $this->fpdf->Cell(7, 5, "", 0, 0);
        $this->fpdf->MultiCell(0, 5, "Pejabat yang berwenang menerbitkan SPPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba serta Bendaharawan bertanggung jawab berdasarkan peraturan-peraturan Keuangan  Negara apabila Negara mendapat rugi akibat kesalahan, kealpaannya.", 0, 1);

        $this->fpdf->Output('I', 'SPPD.pdf');

        exit;
    }





    // Daftar Penerimaan Uang Perjalanan Dinas
    public function pdf3($id)
    {
        $dataBiaya = Biaya::find($id);
        // dd($dataBiaya);

        function ubahTglkeIndo($string){
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
        $this->fpdf = new PDF_MC_Table();
        $this->fpdf->SetMargins(10, 7.5, 10);
        $this->fpdf->AddPage("L", array(330, 210));

        // Judul, Kegiatan, Lokasi
        $this->fpdf->Judul($dataBiaya->kegiatan, $dataBiaya->lokasi);

        // Kegiatan, Kode Rekening, Unit Kerja
        $this->fpdf->Kegiatan($dataBiaya->kegiatan, $dataBiaya->rekening, "Dinas Komunikasi dan Informatika Kabupaten Karanganyar");

        // Tabel Header
        $this->fpdf->SetWidths(Array(10, 62, 90, 30, 25, 37, 30, 26)); // Total width 310
        $this->fpdf->SetAligns(Array("C", "C", "C", "C", "C", "C", "C", "C"));
        $this->fpdf->SetFont('Times', 'B', 12);
        $this->fpdf->Row(Array('No.', 'Nama / NIP', 'Jabatan / Pangkat / Gol. Eselon', 'Uang Harian', 'Uang Transport', 'Biaya Transport', 'Penerimaan', 'Tanda Tangan'));

        // Tabel Body
        $this->fpdf->SetAligns(Array("L", "L", "L", "L", "L", "L", "L", "L"));
        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Row(Array('1', 'Hartono, S.Sos., M.M. 19691015 199003 1 007', 'Kepala Bidang Tata kelola Informatika Dinas Kominfo Kab. Karanganyar / Pembina / IV a', 'Uang Harian', 'Rp80.000', '8 Lt x Rp 12.500 = Rp100.000', 'Rp180.000', ''));
        $this->fpdf->Row(Array('2', 'Suparno 19731103 199803 1 012', 'Analis Sistem Informasi dan Diseminasi Hukum Pada Seksi Persandian dan Keamanan Jaringan dinas Kominfo Kab. Karanganyar / Pengatur Tingkat I / II d', 'Uang Harian', 'Rp60.000', '', 'Rp60.000', ''));
        $this->fpdf->Row(Array('2', 'Yahya Fathoni Amri, S.Kom.', 'Network Analyst Dinas Kominfo Kab. Karanganyar / -', '', 'Rp50.000', '', 'Rp50.000', ''));

        // Tabel Jumlah
        // $this->fpdf->Row(Array('Jumlah', '', 'Rp190.000', 'Rp100.000', 'Rp290.000'));
        $this->fpdf->Cell(162, 7, "Jumlah", 1, 0, "C");
        $this->fpdf->Cell(30, 7, "", 1, 0);
        $this->fpdf->Cell(25, 7, "Rp190.000", 1, 0);
        $this->fpdf->Cell(37, 7, "Rp100.000", 1, 0);
        $this->fpdf->Cell(30, 7, "Rp290.000", 1, 0);
        $this->fpdf->Cell(0, 7, "", 1, 1);

        $this->fpdf->Ln(5);

        // Lunas dibayar
        $this->fpdf->Cell(230, 5, "", 0, 0);
        $this->fpdf->Cell(60, 5, "Lunas dibayar, ".ubahTglkeIndo($dataBiaya->hari_tgl), 0, 0);
        $this->fpdf->Cell(10, 5, "", 0, 1);
        $this->fpdf->Cell(0, 5, "Mengetahui / Setuju Dibayar", 0, 1);

        // Tanda Tangan
        $this->fpdf->Cell(10, 5, "Plt.", 0, 0);
        $this->fpdf->Cell(120, 5, "KEPALA DINAS KOMUNIKASI DAN INFORMATIKA", 0, 0);
        $this->fpdf->Cell(0, 5, "Mengetahui :", 0, 1);

        $this->fpdf->Cell(10, 5, "", 0, 0);
        $this->fpdf->Cell(120, 5, "ASISTEN ADMINISTRASI UMUM SEKRETARIS DAERAH", 0, 0);
        $this->fpdf->Cell(100, 5, "Pejabat Pelaksana Teknis Kegiatan", 0, 0);
        $this->fpdf->Cell(0, 5, "Bendahara Pengeluaran", 0, 1);
        

        $this->fpdf->Cell(10, 5, "", 0, 0);
        $this->fpdf->Cell(120, 5, "Selaku Pengguna Anggaran", 0, 0);
        $this->fpdf->Cell(100, 5, "Bidang Tata Kelola Informatika", 0, 0);
        $this->fpdf->Cell(0, 5, "Dinas Komunikasi dan Informatika", 0, 1);
        $this->fpdf->Ln(20);

        $this->fpdf->Cell(10, 5, "", 0, 0);
        $this->fpdf->SetFont('Times', 'U', 12);
        $this->fpdf->Cell(120, 5, "Drs. SUJARNO, M.Si.", 0, 0);
        $this->fpdf->Cell(100, 5, "Hartono, S.Sos., M.M.", 0, 0);
        $this->fpdf->Cell(0, 5, "ENDANG WERDININGSIH, S.Sos.", 0, 1);
        
        $this->fpdf->Cell(10, 5, "", 0, 0);
        $this->fpdf->SetFont('Times', '', 12);
        $this->fpdf->Cell(120, 5, "NIP.19630107 199003 1 004 ", 0, 0);
        $this->fpdf->Cell(100, 5, "NIP. 19691015 199003 1 007", 0, 0);
        $this->fpdf->Cell(0, 5, "NIP. 19711210 199403 2 002", 0, 1);


        $this->fpdf->Output('I', 'Daftar Uang.pdf');

        exit;
    }
}
