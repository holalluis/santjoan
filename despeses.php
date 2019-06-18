<!doctype html><html><head>
<?php include'imports.php'?>
</head><body>
<?php include'navbar.php'?>
<h3>Despeses previstes</h3><hr>
<?php
  //if(!$admin)die("No ets admin");
?>

<table id=despeses border=1></table>

<script>
  let Despeses = [
    {q:2000, concepte:"compra gran begudes + menjar + cava + coca"},
    {q: 375, concepte:"lloguer equip de so capsa trons"},
    {q: 200, concepte:"música: 4 pau dub"},
    {q: 200, concepte:"música: 3 trio rumba"},
    {q: 150, concepte:"música: 3 el proyecto"},
    {q: 150, concepte:"comissió decoració"},
    {q: 100, concepte:"gestió jaume"},
    {q: 100, concepte:"diners gots reutilitzables"},
    {q: 100, concepte:"música: 2 neus+guitarra"},
    {q: 100, concepte:"música: 1 dj lluis"},
    {q:  80, concepte:"gel"},
    {q:  60, concepte:"cubells"},
    {q:  50, concepte:"benzina motor burra"},
    {q:  50, concepte:"viatge furgo alcohol"},
    {q:  50, concepte:"viatge equip de so"},
    {q:  50, concepte:"música: 1 dj sara vidal"},
    {q:  50, concepte:"feina rincón de la mierda + caixes"},
    {q:  40, concepte:"viatge neus+guitarra"},
    {q:  40, concepte:"viatge el proyecto"},
    {q:  40, concepte:"viatge trio rumba"},
    {q:  40, concepte:"viatge grup pau dub"},
    {q:  30, concepte:"comprar caixes porex"},
    {q:  10, concepte:"domini web"},
  ];

  let table_despeses = document.querySelector('#despeses');
  Despeses.forEach(d=>{
    let nr = table_despeses.insertRow(-1);
    nr.insertCell(-1).innerHTML=d.q;
    nr.insertCell(-1).innerHTML=d.concepte;
  });
  //total
  let total = Object.values(Despeses).map(d=>d.q).reduce((p,c)=>p+c);
  let nr = table_despeses.insertRow(-1);
  nr.style.background='#ccc';
  nr.style.fontWeight='bold';
  nr.insertCell(-1).innerHTML=total;
  nr.insertCell(-1).innerHTML="TOTAL";
</script>

