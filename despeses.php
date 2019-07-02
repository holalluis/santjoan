<!doctype html><html><head>
<?php include'imports.php'?>
  <style>
    tr.total{background:#ccc;font-weight:bold;}
    .number{text-align:right;font-family:monospace;}
  </style>
</head><body><?php include'navbar.php'?>
<h3>Despeses previstes 2019 (eur)</h3><hr>
<table id=despeses border=1></table>
<script>
  let Despeses=[
    //pagades
    {q:1845.00, pagat:true, destí:"ES51 2100 0027 2002 0135 0511", concepte:"compra gran begudes + menjar + cava + coca"}, //max prat
    {q: 534.40, pagat:true, destí:"ES49 0081 0561 1400 0154 7063", concepte:"lloguer equip de so capsa trons"},             //-- capsa de trons
    {q: 340.00, pagat:true, destí:"ES45 2100 0412 7301 0036 7389", concepte:"música: 3 trio rumba"},                       //goyo
    {q: 310.00, pagat:true, destí:"ES24 2100 0665 4301 0090 1339", concepte:"gestió festa"},                               //jaume madaula
    {q: 208.00, pagat:true, destí:"ES36 1491 0001 2921 3274 5825", concepte:"transport coses + alcohol (lio)"},            //lio dimant
    {q: 200.00, pagat:true, destí:"ES85 0182 8730 0102 0091 3346", concepte:"música: 3 el proyecto"},                      //pau (el proyecto)
    {q: 192.53, pagat:true, destí:"ES26 3025 0014 0714 0008 3269", concepte:"comissió decoració"},                         //georgina nicolás
    {q: 140.00, pagat:true, destí:"ES52 2100 0658 0101 0044 3754", concepte:"dj fast fingers + transport"},                //lluís bosch
    {q: 140.00, pagat:true, destí:"ES44 2100 0212 1701 0067 7747", concepte:"música+viatge: neus i miquel"},               //neus
    {q:  60.00, pagat:true, destí:"ES86 3025 0002 4714 3341 4006", concepte:"cubells"},                                    //laia gausà
    {q:  50.00, pagat:true, destí:"ES24 2100 0665 4301 0090 1339", concepte:"benzina motor burra"},                        //jaume madaula
    {q:  50.00, pagat:true, destí:"ES13 2100 2904 0902 1832 4019", concepte:"rincón de la mierda"},                        //maria andreu hayles
    {q:  50.00, pagat:true, destí:"ES18 2100 0695 6101 0034 0733", concepte:"transport so+alcohol (manel)"},               //manel dalmases
    {q:  50.00, pagat:true, destí:"ES97 2100 0298 5001 0159 5092", concepte:"música: 1 dj sara"},                          //sara vidal
    {q:  50.00, pagat:true, destí:"ES59 2100 0778 9601 0083 7948", concepte:"comissió gots"},                               //-- duna
    {q:  40.00, pagat:true, destí:"ES52 2100 0658 0101 0044 3754", concepte:"transport equip de so (diana)"},              //lluís bosch
    {q:  35.00, pagat:true, destí:"metàl·lic",                     concepte:"gel"},                                        //gerard codolà
    {q:  30.00, pagat:true, destí:"ES19 3025 0014 0014 0008 4417", concepte:"transport so+alcohol (edu)"},                 //edu madaula
    {q:  30.00, pagat:true, destí:"ES51 2100 0027 2002 0135 0511", concepte:"transport so+alcohol (max)"},                 //max prat
    {q:  30.00, pagat:true, destí:"ES24 2100 0665 4301 0090 1339", concepte:"transport so+alcohol (jaume)"},               //jaume madaula
    {q:  30.00, pagat:true, destí:"ES43 1491 0001 2021 3501 9723", concepte:"transport so+alcohol (yves)"},                //yves dimant
    {q:  30.00, pagat:true, destí:"metàl·lic",                     concepte:"caixes porex"},                               //ho va comprar gerard codolà
    {q:  25.00, pagat:true, destí:"ES74 2100 0462 3301 0090 5065", concepte:"devolucions (miquel)"},                       //-- miquel felip peig
    {q:  23.00, pagat:true, destí:"ES52 2100 0658 0101 0044 3754", concepte:"web"},                                        //lluís bosch
    {q:  17.00, pagat:true, destí:"ES86 3025 0002 4714 3341 4006", concepte:"coca st joan"},                               //laia gausà
    //no pagades
  ];

  //backend - calcula totals
  let Totals={
    total    :{q:   0,    descr:"TOTAL despeses previstes (pagades + no pagades)" },
    pagat    :{q:   0,    descr:"Despeses pagades " },
    no_pagat :{q:   0,    descr:"Despeses no pagades"},
    banc     :{q: 340.07, descr:"Diners al banc actualment" },
    ingressat:{q:   0,    descr:"Ingressat total real (banc + pagat)"},
    benefici :{q:   0,    descr:"Previsió diners sobrants i/o imprevistos (banc - no-pagat)"},
  };
  Totals.total.q     = Object.values(Despeses).map(d=>d.q).reduce((p,c)=>p+c);
  Totals.pagat.q     = Object.values(Despeses).filter(d=>d.pagat==true ).map(d=>(d.q)).reduce((p,c)=>p+c);
  Totals.no_pagat.q  = Object.values(Despeses).filter(d=>d.pagat==false).map(d=>(d.q)).reduce((p,c)=>p+c);
  Totals.benefici.q  = Totals.banc.q - Totals.no_pagat.q;
  Totals.ingressat.q = Totals.banc.q + Totals.pagat.q;
  //frontend - dibuixa taula al DOM
  (function(){
    let table_despeses = document.querySelector('#despeses');
    //despeses
    Despeses.forEach(d=>{
      let nr=table_despeses.insertRow(-1);
      nr.insertCell(-1).outerHTML=`<td class=number>${d.q}`;
      nr.insertCell(-1).innerHTML=d.concepte;
      nr.insertCell(-1).innerHTML=d.pagat?"<b style=color:lightgreen>pagat</b>":"<b style=color:red>no pagat</b>";
      nr.insertCell(-1).innerHTML=d.destí;
    });
    //totals
    Object.entries(Totals).forEach(([key,obj])=>{
      let nr=table_despeses.insertRow(-1);
      nr.classList.add('total');
      nr.insertCell(-1).outerHTML=`<td class=number>${Math.round(100*obj.q)/100}`;
      nr.insertCell(-1).outerHTML="<td colspan=3>"+obj.descr;
    });
  })();
</script>
