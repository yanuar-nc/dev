jQuery(document).ready(function() {
    
    "use strict";
    
    /***** PIE CHART *****/
    
    var piedata = [
        { label: " &nbsp; Warriors (M2)", data: [[1,40]], color: '#D9534F'},
        { label: " &nbsp; Vikings (14)", data: [[1,90]], color: '#F0AD4E'},
        { label: " &nbsp; Raiders (F27)", data: [[1,70]], color: '#428BCA'},
        { label: " &nbsp; Patriots (XK1)", data: [[1,80]], color: '#5BC0DE'}
	 ];
    
    var data = <?php echo $bitch; ?>;
    var xxx  = [ { label: "   Warriors (M2)", data: [[1,40]], color: '#D9534F'}, { label: "   Vikings (14)", data: [[1,90]], color: '#F0AD4E'}, { label: "   Raiders (F27)", data: [[1,70]], color: '#428BCA'}, { label: "   Patriots (XK1)", data: [[1,80]], color: '#5BC0DE'} ];

        jQuery.plot('#piechart', data, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 2/3,
                        formatter: labelFormatter,
                        threshold: 0.1
                    }
                }
            },
            grid: {
                hoverable: true,
                clickable: true
            }
        });

    /*
    $.getJSON('http://127.0.0.1:90/vivelle-wesley/products/json_product', function( data ){



    });    
*/
    
    function labelFormatter(label, series) {
		return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}
});
