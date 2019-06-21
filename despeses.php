<!doctype html><html><head>
<?php include'imports.php'?>
  <style>
    tr.total{
      background:#ccc;
      font-weight:bold;
    }
  </style>
</head><body><?php include'navbar.php'?>
<h3>Despeses previstes (eur)</h3><hr>
<table id=despeses border=1></table>

<script>
  let Despeses = [
    {q:2000, pagat:true, concepte:"compra gran begudes + menjar + cava + coca"},
    {q: 100, pagat:true, concepte:"gestió jaume"},
    {q:  50, pagat:true, concepte:"benzina motor burra"},
    {q: 375, pagat:false, concepte:"lloguer equip de so capsa trons"},
    {q: 300, pagat:false, concepte:"música: 3 trio rumba"},
    {q: 250, pagat:false, concepte:"comissió decoració"},
    {q: 150, pagat:false, concepte:"música: 3 el proyecto"},
    {q: 100, pagat:false, concepte:"música: 2 neus+guitarra"},
    {q: 100, pagat:false, concepte:"música: 1 dj fast fingers"},
    {q:  80, pagat:false, concepte:"gel"},
    {q:  60, pagat:false, concepte:"cubells"},
    {q:  50, pagat:false, concepte:"viatge furgo alcohol"},
    {q:  50, pagat:false, concepte:"viatge equip de so"},
    {q:  50, pagat:false, concepte:"música: 1 dj sara vidal"},
    {q:  50, pagat:false, concepte:"feina rincón de la mierda + caixes"},
    {q:  40, pagat:false, concepte:"viatge neus+guitarra"},
    {q:  40, pagat:false, concepte:"viatge el proyecto"},
    {q:  40, pagat:false, concepte:"viatge trio rumba"},
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

  //totals
  let total    = Object.values(Despeses).map(d=>d.q).reduce((p,c)=>p+c);
  let gastat   = Object.values(Despeses).filter(d=>d.pagat).map(d=>(d.q)).reduce((p,c)=>p+c);
  let no_pagat = total - gastat;
  let banc     = 2150;
  let benefici = banc - no_pagat;
  let ingressat = banc + gastat;

  let nr = table_despeses.insertRow(-1); nr.classList.add('total');
  nr.insertCell(-1).innerHTML=total;
  nr.insertCell(-1).outerHTML="<td colspan=2>TOTAL despeses previstes (diners totals a gastar)";
  nr = table_despeses.insertRow(-1); nr.classList.add('total');
  nr.insertCell(-1).innerHTML=gastat;
  nr.insertCell(-1).outerHTML="<td colspan=2>TOTAL despeses pagades";
  nr = table_despeses.insertRow(-1); nr.classList.add('total');
  nr.insertCell(-1).innerHTML=no_pagat;
  nr.insertCell(-1).outerHTML="<td colspan=2>TOTAL despeses no pagades (= previstes - pagades)";
  nr = table_despeses.insertRow(-1); nr.classList.add('total');
  nr.insertCell(-1).innerHTML=banc;
  nr.insertCell(-1).outerHTML="<td colspan=2>Diners al banc";
  nr = table_despeses.insertRow(-1); nr.classList.add('total');
  nr.insertCell(-1).innerHTML=benefici;
  nr.insertCell(-1).outerHTML="<td colspan=2>Previsió diners sobrants (banc - no-pagats)";

  nr = table_despeses.insertRow(-1); nr.classList.add('total');
  nr.insertCell(-1).innerHTML=ingressat;
  nr.insertCell(-1).outerHTML="<td colspan=2>TOTAL ingresssos (banc + pagats)";
</script>
