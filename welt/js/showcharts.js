
       // 基于准备好的dom，初始化echarts实例
        var myChart1 = echarts.init(document.getElementById('main1'));

        $.get('data.json').done(function (data) {
             var servicedata=[];
             for(var i=0;i<data.edu.length;i++){
                 var obj=new Object();
                 obj.name=data.edu[i]; 
                 obj.value=data.edudata[i];
                 servicedata[i]=obj;
             }
            myChart1.setOption({
                title:{
                    text:'学历比例',
                    x:'center'
                },
                tooltip:{
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend:{
                    top:50
                },
                series : [
                    {
                        name: '学历比例',
                        type: 'pie',
                        radius : '40%',
                        center: ['50%', '50%'],
                        data:servicedata,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            })
        })

    // 基于准备好的dom，初始化echarts实例
        var myChart2 = echarts.init(document.getElementById('main2'));

        $.get('data.json').done(function (data) {
            var servicedata=[];
            for(var i=0;i<data.title.length;i++){
                var obj=new Object();
                obj.name=data.title[i]; 
                obj.value=data.titledata[i];
                servicedata[i]=obj;
            }
           myChart2.setOption({
               title:{
                   text:'职称比例',
                   x:'center'
               },
               tooltip:{
                   trigger: 'item',
                   formatter: "{a} <br/>{b} : {c} ({d}%)"
               },
               legend:{
                   top:50
               },
               series : [
                   {
                       name: '职称比例',
                       type: 'pie',
                       radius : '40%',
                       center: ['50%', '50%'],
                       data:servicedata,
                       itemStyle: {
                           emphasis: {
                               shadowBlur: 10,
                               shadowOffsetX: 0,
                               shadowColor: 'rgba(0, 0, 0, 0.5)'
                           }
                       }
                   }
               ]
           })
       })
    // 基于准备好的dom，初始化echarts实例
    /*    var myChart3 = echarts.init(document.getElementById('main3'));

        // 指定图表的配置项和数据
        $.get('data.json').done(function (data) {
            var servicedata=[];
            for(var i=0;i<data.name.length;i++){
                var obj=new Object();
                obj.name=data.name[i]; 
                obj.value=data.data[i];
                servicedata[i]=obj;
            }
           myChart3.setOption({
               title:{
                   text:'学历比例',
                   x:'center'
               },
               tooltip:{
                   trigger: 'item',
                   formatter: "{a} <br/>{b} : {c} ({d}%)"
               },
               legend:{
                   top:50
               },
               series : [
                   {
                       name: '学历比例',
                       type: 'pie',
                       radius : '40%',
                       center: ['50%', '50%'],
                       data:servicedata,
                       itemStyle: {
                           emphasis: {
                               shadowBlur: 10,
                               shadowOffsetX: 0,
                               shadowColor: 'rgba(0, 0, 0, 0.5)'
                           }
                       }
                   }
               ]
           })
       })
*/

