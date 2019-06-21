<!doctype html><html><head>
<?php include'imports.php'?>
</head><body>
<?php include'navbar.php'?>
<h3>Despeses previstes (eur)</h3><hr>
<?php
  //if(!$admin)die("No ets admin");
?>

<table id=despeses border=1></table>

<script>
  let Despeses = [
    {q:2000, pagat:true, concepte:"compra gran begudes + menjar + cava + coca"},
    {q: 375, pagat:false, concepte:"lloguer equip de so capsa trons"},
    {q: 300, pagat:false, concepte:"música: 3 trio rumba"},
    {q: 150, pagat:false, concepte:"música: 3 el proyecto"},
    {q: 350, pagat:false, concepte:"comissió decoració"},
    {q: 100, pagat:true, concepte:"gestió jaume"},
    {q: 100, pagat:false, concepte:"diners gots reutilitzables"},
    {q: 100, pagat:false, concepte:"música: 2 neus+guitarra"},
    {q: 100, pagat:false, concepte:"música: 1 dj lluis"},
    {q:  80, pagat:false, concepte:"gel"},
    {q:  60, pagat:false, concepte:"cubells"},
    {q:  50, pagat:true, concepte:"benzina motor burra"},
    {q:  50, pagat:false, concepte:"viatge furgo alcohol"},
    {q:  50, pagat:false, concepte:"viatge equip de so"},
    {q:  50, pagat:false, concepte:"música: 1 dj sara vidal"},
    {q:  50, pagat:false, concepte:"feina rincón de la mierda + caixes"},
    {q:  40, pagat:false, concepte:"viatge neus+guitarra"},
    {q:  40, pagat:false, concepte:"viatge el proyecto"},
    {q:  40, pagat:false, concepte:"viatge trio rumba"},
    {q:  40, pagat:false, concepte:"viatge grup pau dub"},
    {q:  30, pagat:false, concepte:"comprar caixes porex"},
    {q:  23, pagat:false, concepte:"domini web"},
  ];

  let table_despeses = document.querySelector('#despeses');
  Despeses.forEach(d=>{
    let nr = table_despeses.insertRow(-1);
    nr.insertCell(-1).outerHTML=`<td align=right>${d.q}</td>`;
    nr.insertCell(-1).innerHTML=d.concepte;
    nr.insertCell(-1).innerHTML=d.pagat?"pagat":"";
  });
  //total
  let total = Object.values(Despeses).map(d=>d.q).reduce((p,c)=>p+c);
  let nr = table_despeses.insertRow(-1);
  nr.style.background='#ccc';
  nr.style.fontWeight='bold';
  nr.insertCell(-1).innerHTML=total;
  nr.insertCell(-1).innerHTML="TOTAL pressupost";

  let gastat = Object.values(Despeses).filter(d=>d.pagat).map(d=>(d.q)).reduce((p,c)=>p+c);
  nr = table_despeses.insertRow(-1);
  nr.style.background='#ccc';
  nr.style.fontWeight='bold';
  nr.insertCell(-1).innerHTML=gastat;
  nr.insertCell(-1).innerHTML="TOTAL gastat";

  let disponible  = total - gastat;
  nr = table_despeses.insertRow(-1);
  nr.style.background='#ccc';
  nr.style.fontWeight='bold';
  nr.insertCell(-1).innerHTML=disponible;
  nr.insertCell(-1).innerHTML="TOTAL disponible";
</script>

