<?php

function isWeekend($date) {
    return (date('N', strtotime($date)) >= 6);
}

?>

<table border="1" cellpadding="5">
    <tr>

        <td rowspan="2">No</td>
        <td rowspan="2">Nama</td>
        <td rowspan="2">Nip</td>
        <td rowspan="2" colspan="4">Mata Pelajaran</td>
        <td colspan="<?php echo $hari ?>">Bulan : <?php echo $bulan ." - ". $tahun?> </td>
        <td colspan="2">Total</td>

    </tr>
    <tr>

        <?php for($a=1; $a <= $hari; $a++) { ?>
            <td style="background: <?php echo isWeekend($a.'-'.$bulan.'-'.$tahun) ==1 ? '#737373' :'#fff'?>"><?php echo $a ?></td>
        <?php } ?>
        <td>H</td>
        <td>A</td>

    </tr>
    <?php $n=1; foreach ($data as $x){ ?>
    <tr>
        <td><?php echo $n++ ?></td>
        <td><?php echo $x->nama_guru ?></td>
        <td><?php echo $x->nip ?></td>
        <td><?php echo $x->mata_pelajaran ?></td>
        <td><?php echo $x->kelas ?></td>
        <td><?php echo $x->jurusan ?></td>
        <td><?php echo $x->kelas_paralel ?></td>

        <?php
            $h = 0;
            $i =0;
            for($a=1; $a <= $hari; $a++) { ?>
            <?php
                $hadir = "h".$a;
                $keahadiran = $x->$hadir;
                $h = $h + ( $keahadiran==1 ? 1 :0 );
                $i = $i + ( $keahadiran==0 ? 1 :0 );
            ?>

            <td style="background: <?php echo isWeekend($a.'-'.$bulan.'-'.$tahun) ==1 ? '#737373' :'#fff'?>"><?php echo $keahadiran ?></td>
        <?php } ?>
        <td><?php echo $h ?></td>
        <td><?php echo $i ?></td>

    </tr>
    <?php } ?>
</table>