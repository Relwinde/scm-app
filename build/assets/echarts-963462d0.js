$(function(B){var e=[{name:"sales",type:"bar",data:[10,15,9,18,10,15]},{name:"profit",type:"line",smooth:!0,data:[8,5,25,10,10]},{name:"growth",type:"bar",data:[10,14,10,15,9,25]}],y=document.getElementById("echarteg1"),t=echarts.init(y),b={grid:{top:"6",right:"0",bottom:"17",left:"25"},xAxis:{data:["2014","2015","2016","2017","2018"],axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},tooltip:{show:!0,showContent:!0,alwaysShowContent:!0,triggerOn:"mousemove",trigger:"axis",axisPointer:{label:{show:!1}}},yAxis:{splitLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},series:e,color:["#0774f8","#09ad95","#d43f8d"]};t.setOption(b),window.addEventListener("resize",function(){t.resize()});var a=[{name:"sales",type:"line",smooth:!0,data:[12,25,12,35,12,38],color:["#0774f8"]},{name:"Profit",type:"line",smooth:!0,size:10,data:[8,12,28,10,10,12],color:["#d43f8d"]}],x=document.getElementById("echart2"),i=echarts.init(x),g={grid:{top:"6",right:"0",bottom:"17",left:"25"},xAxis:{data:["2014","2015","2016","2017","2018"],axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},yAxis:{splitLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},series:a};i.setOption(g),window.addEventListener("resize",function(){i.resize()});var h={grid:{top:"6",right:"0",bottom:"17",left:"32"},xAxis:{type:"value",axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},yAxis:{type:"category",data:["2014","2015","2016","2017","2018"],splitLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLine:{lineStyle:{color:"#c0dfd8"}},axisLabel:{fontSize:10,color:"#77778e"}},series:e,color:["#0774f8","#09ad95","#d43f8d"]},f=document.getElementById("echart3"),r=echarts.init(f);r.setOption(h),window.addEventListener("resize",function(){r.resize()});var p={grid:{top:"6",right:"0",bottom:"17",left:"32"},xAxis:{type:"value",axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},yAxis:{type:"category",data:["2014","2015","2016","2017","2018"],splitLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},series:a,color:["#0774f8","#d43f8d","#09ad95"]},L=document.getElementById("echart4"),o=echarts.init(L);o.setOption(p),window.addEventListener("resize",function(){o.resize()});var n=[{name:"sales",type:"bar",stack:"Stack",data:[14,18,20,14,29,21,25,14,24]},{name:"Profit",type:"bar",stack:"Stack",data:[12,14,15,50,24,24,10,20,30]}],S={grid:{top:"6",right:"0",bottom:"17",left:"25"},xAxis:{data:["2010","2011","2012","2013","2014","2015","2016","2017","2018"],axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},yAxis:{splitLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},series:n,color:["#0774f8","#d43f8d"]},v=document.getElementById("echart5"),l=echarts.init(v);l.setOption(S),window.addEventListener("resize",function(){l.resize()});var m={grid:{top:"6",right:"10",bottom:"17",left:"32"},xAxis:{type:"value",axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},yAxis:{type:"category",data:["2010","2011","2012","2013","2014","2015","2016","2017","2018"],splitLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},series:n,color:["#0774f8","#d43f8d"]},z=document.getElementById("echart6"),s=echarts.init(z);s.setOption(m),window.addEventListener("resize",function(){s.resize()});var u=[{name:"data",type:"line",data:[20,20,36,18,15,20,25,20]}],w={grid:{top:"6",right:"0",bottom:"17",left:"25"},xAxis:{data:["2011","2012","2013","2014","2015","2016","2017","2018"],axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},yAxis:{splitLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},series:u,color:["#0774f8"]},A=document.getElementById("echart7"),c=echarts.init(A);c.setOption(w),window.addEventListener("resize",function(){c.resize()});var E=[{name:"data",type:"line",smooth:!0,data:[20,20,36,18,15,20,25,20]}],C={grid:{top:"6",right:"0",bottom:"17",left:"25"},xAxis:{data:["2011","2012","2013","2014","2015","2016","2017","2018"],axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},yAxis:{splitLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLine:{lineStyle:{color:"rgba(119, 119, 142, 0.2)"}},axisLabel:{fontSize:10,color:"#77778e"}},series:E,color:["#d43f8d"]},O=document.getElementById("echart8"),d=echarts.init(O);d.setOption(C),window.addEventListener("resize",function(){d.resize()})});