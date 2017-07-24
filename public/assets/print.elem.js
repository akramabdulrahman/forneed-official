/**
 * Created by akramabdulrahman on 4/6/2017.
 */
function PrintElem(elem)
{
    _PrintElem(elem);

    var mywindow = window.open('', 'PRINT', 'height=400,width=600');


    mywindow.document.write('<html><head><title>' + 'Report Made By forneeds version 0.0.32 funded by Al Taawon organization'  + '</title>');

    mywindow.document.write('</head><body >');
//      	mywindow.document.write('<h1>' + document.title  + '</h1>');

    var img = document.getElementById("image_to_pring");
    setTimeout(function () {
        img = document.getElementById("image_to_pring");

        mywindow.document.write('<img src="'+ img.src+'"/>');
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();


    } , 1000);
    return true;

}

function _PrintElem(elem)
{
    var canvas = $('#canvas');
    var can_f = $('#can_f');
    var elem1 = document.getElementById(elem)

    var a = html2canvas(elem1, {
        onrendered: function(canvas) {
            var ctx = canvas.getContext('2d');
            cropImageFromCanvas(ctx,canvas);
            // setTimeout(function(){
            //     var canvasImg = canvas.toDataURL("image/png");
            //     var link = document.createElement('a');
            //     link.href = canvasImg.replace("image/png", "image/octet-stream");
            //     link.visibility = 'hidden';
            //     document.body.appendChild(link);
            //     link.download='image.png';
            //     link.click();
            //     $('#can_f').html('<img src="'+canvasImg+'" alt="">');
            // },0)
        }
        ,
        allowTaint: true
    });

    // var printContent = document.getElementById("can_f");
    // var printWindow = window.open("", "","left=50,top=50");
    // printWindow.document.write(printContent.innerHTML);
    // printWindow.document.write("<script src=\'http://code.jquery.com/jquery-1.10.1.min.js\'><\/script>");
    // printWindow.document.write("<script>$(window).load(function(){ close();});<\/script>");
    // printWindow.document.close();

    // var win=window.open();

    //win.document.write("<br><img src='"+canvas[0].toDataURL("image/png")+"'/>");

    // win.print();
    //win.location.reload();


    // console.log(can);

    // var mywindow = window.open('', 'PRINT', 'height=842,width=595');
    // mywindow.document.write(can.html());
    // mywindow.document.close(); // necessary for IE >= 10
    // mywindow.focus(); // necessary for IE >= 10*/
    // //mywindow.print();
    // //mywindow.close();

    return true;

}


function cropImageFromCanvas(ctx, canvas) {

    var w = canvas.width,
        h = canvas.height,
        pix = {x:[], y:[]},
        imageData = ctx.getImageData(0,0,canvas.width,canvas.height),
        x, y, index;

    for (y = 0; y < h; y++) {
        for (x = 0; x < w; x++) {
            index = (y * w + x) * 4;
            if (imageData.data[index+3] > 0) {

                pix.x.push(x);
                pix.y.push(y);

            }
        }
    }
    pix.x.sort(function(a,b){return a-b});
    pix.y.sort(function(a,b){return a-b});
    var n = pix.x.length-1;

    w = pix.x[n] - pix.x[0];
    h = pix.y[n] - pix.y[0];
    var cut = ctx.getImageData(pix.x[0], pix.y[0], w, h);

    canvas.width = w;
    canvas.height = h;
    ctx.putImageData(cut, 0, 0);

    var canvasImg = canvas.toDataURL("image/png");
    var link = document.createElement('a');
    link.href = canvasImg.replace("image/png", "image/octet-stream");
   // link.visibility = 'hidden';
    document.body.appendChild(link);
    link.download='image.png';
   // $(document).append(link);
  //  $('#print-assets').append(link);
 //	$(link).click();
    $('#can_f').html('<img id="image_to_pring" src="'+canvasImg+'" alt="">');

}
function print_voucher(elem){

    var canvas = $('#canvas');
    var can_f = $('#can_f');
    var elem1 = document.getElementById(elem)


    var a = html2canvas(elem1, {
        onrendered: function(canvas) {
            var ctx = canvas.getContext('2d');
            cropImageFromCanvas(ctx,canvas);

        },
        allowTaint: true
    });
}
