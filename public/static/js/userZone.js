$(document).ready(function(){
var chartData = [{label: 'Karnataka', value: 65 },{label: 'Maharashtra', value: 25},{label: 'Other', value: 15},  ]
let chartConfig = {
    shapes: [

        {
            type: 'circle',
            id: '1950',
            backgroundColor: '#141c75',
            borderColor: '#141c75',
            borderWidth: '1px',
            cursor: 'pointer',
            label: 
            {
              text: 'Karnataka 65%',

              fontColor: '#666666',
              fontFamily: 'Roboto',
              offsetX: '55px'
            },
            size: '10px',
            x: '70%',
            y: '47%'
          },
          {
            type: 'circle',
            id: '1990',
            backgroundColor: '#6f6dac',
            borderColor: '#6f6dac',
            borderWidth: '1px',
            cursor: 'pointer',
            label: {
              text: 'Maharashtra 25%',
              fontColor: '#666666',
              fontFamily: 'Roboto',
              offsetX: '60px'
            },
            size: '10px',
            x: '70%',
            y: '67%'
          },
          {
            type: 'circle',
            id: '2000',
            backgroundColor: '#b7b6d5',
            borderColor: '#b7b6d5',
            borderWidth: '1px',
            cursor: 'pointer',
            label: {
              text: 'Others 15%',
              fontColor: '#666666',
              fontFamily: 'Roboto',
              offsetX: '45px'
            },
            size: '10px',
            x: '70%',
            y: '87%'
          },
      {
        type: 'zingchart.maps',
        options: {
          name: 'ind',
          panning: false, // turn of zooming. Doesn't work with bounding box
          zooming: false,
          scrolling: false,
          style: {
            tooltip: {
              borderColor: '#fff',
              borderWidth: '1px',
              fontSize: '18px'
            },
            borderColor: '#fff',
            borderWidth: '1px',
            controls: {
              visible: false, // turn of zooming. Doesn't work with bounding box
  
            },
            hoverState: {
              alpha: .28
            },
             //Northern California:
             group: 1,
             backgroundColor: '#b7b6d5',

            //  group :2 , 
            //  backgroundColor :"#000",


              
        
            items: {
               
              KA: {
                group: 2,

                tooltip: {
                  text: 'Karnataka has 30 users',
                  backgroundColor: '#9391c1'
                },
                backgroundColor: '#141c75',
                label: {
                  visible: false
                }
              },
              MH: {
                group: 2,

                tooltip: {
                  text: 'Maharashtra has 30 users',
                  backgroundColor: '#9391c1'
                },
                backgroundColor: '#6f6dac',
                label: {
                  visible: false
                }
              },
              UP: {
                group: 3,
                backgroundColor: '#9391c1',
                label: {
                  visible: false
                }
              },
              PB: {
                group: 3,
                backgroundColor: '#9391c1',
                label: {
                  visible: false
                }
              },
              HR: {
                group: 3,

                backgroundColor: '#9391c1',
                label: {
                  visible: false
                }
              },
              CT: {
                group: 3,

                backgroundColor: '#9391c1',
                label: {
                  visible: false
                }
              },
              
             
            },



            




            label: { // text displaying. Like valueBox
              fontSize: '15px',
              visible: false
            }
          },
          zooming: false // turn of zooming. Doesn't work with bounding box
        }
      }
    ]
  }
  
  zingchart.loadModules('maps,maps-ind,');
  zingchart.render({
    id: 'myzonechart',
    data: chartConfig,
    height: '100%',
    width: '100%',
  });

});