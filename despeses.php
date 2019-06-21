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
    {q: 250, pagat:true, concepte:"comissió decoració"},
    {q: 100, pagat:true, concepte:"gestió jaume"},
    {q:  50, pagat:true, concepte:"benzina motor burra"},
    {q: 375, pagat:false, concepte:"lloguer equip de so capsa trons"},
    {q: 300, pagat:false, concepte:"música: 3 trio rumba"},
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
  let Totals = {
    total     : {q:    0, descr:"TOTAL despeses previstes (pagades + no pagades)" },
    pagat     : {q:    0, descr:"Despeses pagades " },
    no_pagat  : {q:    0, descr:"Despeses no pagades"},
    banc      : {q: 1900, descr:"Diners al banc actualment" },
    benefici  : {q:    0, descr:"Previsió diners sobrants (banc - no-pagat)"},
    ingressat : {q:    0, descr:"Ingressat total real (banc + pagat)"},
  };

  Totals.total.q     = Object.values(Despeses).map(d=>d.q).reduce((p,c)=>p+c);
  Totals.pagat.q     = Object.values(Despeses).filter(d=>d.pagat==true ).map(d=>(d.q)).reduce((p,c)=>p+c);
  Totals.no_pagat.q  = Object.values(Despeses).filter(d=>d.pagat==false).map(d=>(d.q)).reduce((p,c)=>p+c);
  Totals.benefici.q  = Totals.banc.q - Totals.no_pagat.q;
  Totals.ingressat.q = Totals.banc.q + Totals.pagat.q;

  //dibuixa taula
  Object.entries(Totals).forEach(([key,obj])=>{
    let nr = table_despeses.insertRow(-1);
    nr.classList.add('total');
    nr.insertCell(-1).innerHTML=obj.q;
    nr.insertCell(-1).outerHTML="<td colspan=2>"+obj.descr;
  });
</script>
