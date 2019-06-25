<!doctype html><html><head>
<?php include'imports.php'?>
  <style>
    tr.total{
      background:#ccc;
      font-weight:bold;
    }
    .number{
      text-align:right;
    }
  </style>
</head><body><?php include'navbar.php'?>
<h3>Despeses previstes 2019 (eur)</h3><hr>
<table id=despeses border=1></table>
<script>
  let Despeses = [
    {q:2000, pagat:true, concepte:"compra gran begudes + menjar + cava + coca"}, //ES51 2100 0027 2002 0135 0511 -- max prat
    {q: 340, pagat:true, concepte:"música: 3 trio rumba"},                       //ES45 2100 0412 7301 0036 7389 -- goyo
    {q: 250, pagat:true, concepte:"comissió decoració"},                         //ES26 3025 0014 0714 0008 3269 -- georgina nicolás
    {q: 200, pagat:true, concepte:"música: 3 el proyecto"},                      //ES85 0182 8730 0102 0091 3346 -- pau (el proyecto)
    {q: 100, pagat:true, concepte:"gestió festa"},                               //ES24 2100 0665 4301 0090 1339 -- jaume madaula
    {q:  60, pagat:true, concepte:"cubells"},                                    //ES86 3025 0002 4714 3341 4006 -- laia gausà
    {q:  50, pagat:true, concepte:"benzina motor burra"},                        //ES24 2100 0665 4301 0090 1339 -- jaume madaula
    {q:  50, pagat:true, concepte:"rincón de la mierda"},                        //ES13 2100 2904 0902 1832 4019 -- maria andreu hayles
    {q:  50, pagat:true, concepte:"transport so+alcohol (manel)"},               //ES18 2100 0695 6101 0034 0733 -- manel dalmases
    {q:  35, pagat:true, concepte:"gel"},                                        //                    metàl·lic -- gerard codolà
    {q:  30, pagat:true, concepte:"transport so+alcohol (edu)"},                 //ES19 3025 0014 0014 0008 4417 -- edu madaula
    {q:  30, pagat:true, concepte:"transport so+alcohol (max)"},                 //ES51 2100 0027 2002 0135 0511 -- max prat
    {q:  30, pagat:true, concepte:"transport so+alcohol (jaume)"},               //ES24 2100 0665 4301 0090 1339 -- jaume madaula
    {q:  30, pagat:true, concepte:"transport so+alcohol (yves)"},                //ES43 1491 0001 2021 3501 9723 -- yves dimant
    {q: 375, pagat:false, concepte:"lloguer equip de so capsa trons"},           // -- capsa de trons
    {q: 140, pagat:false, concepte:"música + viatge: neus+guitarra"},            // -- neus
    {q: 100, pagat:false, concepte:"música: dj fast fingers"},                   // -- jo
    {q:  50, pagat:false, concepte:"comissió gots"},                             // -- duna
    {q:  50, pagat:false, concepte:"música: 1 dj sara vidal"},                   // -- sara vidal
    {q:  40, pagat:false, concepte:"viatge equip de so"},                        // -- jo
    {q:  30, pagat:false, concepte:"transport coses (lio)"},                     // -- lio
    {q:  30, pagat:false, concepte:"comprar caixes porex"},                      //aclarir si es van comprar
    {q:  23, pagat:false, concepte:"domini web"},                                // -- jo
  ];

  //totals
  let Totals = {
    total     : {q:    0, descr:"TOTAL despeses previstes (pagades + no pagades)" },
    pagat     : {q:    0, descr:"Despeses pagades " },
    no_pagat  : {q:    0, descr:"Despeses no pagades"},
    banc      : {q: 2125, descr:"Diners al banc actualment" },
    ingressat : {q:    0, descr:"Ingressat total real (banc + pagat)"},
    benefici  : {q:    0, descr:"Previsió diners sobrants i/o imprevistos (banc - no-pagat)"},
  };
  Totals.total.q     = Object.values(Despeses).map(d=>d.q).reduce((p,c)=>p+c);
  Totals.pagat.q     = Object.values(Despeses).filter(d=>d.pagat==true ).map(d=>(d.q)).reduce((p,c)=>p+c);
  Totals.no_pagat.q  = Object.values(Despeses).filter(d=>d.pagat==false).map(d=>(d.q)).reduce((p,c)=>p+c);
  Totals.benefici.q  = Totals.banc.q - Totals.no_pagat.q;
  Totals.ingressat.q = Totals.banc.q + Totals.pagat.q;

  //frontend - dibuixa despeses
  let table_despeses = document.querySelector('#despeses');
  Despeses.forEach(d=>{
    let nr = table_despeses.insertRow(-1);
    nr.insertCell(-1).outerHTML=`<td class=number>${d.q}`;
    nr.insertCell(-1).innerHTML=d.concepte;
    nr.insertCell(-1).innerHTML=d.pagat?"pagat":"<b>no pagat</b>";
  });

  //frontend - dibuixa totals
  Object.entries(Totals).forEach(([key,obj])=>{
    let nr = table_despeses.insertRow(-1);
    nr.classList.add('total');
    nr.insertCell(-1).outerHTML=`<td class=number>${obj.q}`;
    nr.insertCell(-1).outerHTML="<td colspan=2>"+obj.descr;
  });
</script>
