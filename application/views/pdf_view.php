<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <style type="text/css">
        #pdf_container { background: #ccc; text-align: center; display: none; padding: 5px;overflow:auto }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf_viewer.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url() ?>mods/assets/js/jquery.min.js"></script>
</head>
<body>
        
    <?php 

        

        $files = base_url().'mods/assets/book/'.$file;

    ?>
      <button id="zoominbutton" class="btn btn-danger" onclick="zoomIn()" type="button">zoom in</button>
      <button id="zoomoutbutton" class="btn btn-success" onclick="zoomOut()" type="button">zoom out</button>
    <div id="pdf_container">
    </div>


    <script type="text/javascript">
        
        var pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';
        var pdfDoc = null;
        var scale = 1; //Set Scale for Zoom.
        var resolution = IsMobile() ? 1.5 : 1; //Set Resolution as per Desktop and Mobile.
        LoadPdfFromUrl('<?php echo $files ?>',scale);

        function LoadPdfFromUrl(url,size) {
            $('#pdf_container').html('');
            //Read PDF from URL.
            pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
                pdfDoc = pdfDoc_;

                //Reference the Container DIV.
                var pdf_container = document.getElementById("pdf_container");
                pdf_container.style.display = "block";
                pdf_container.style.height = IsMobile() ? "50%" : "50%";

                //Loop and render all pages.
                for (var i = 1; i <= pdfDoc.numPages; i++) {
                    RenderPage(pdf_container, i,size);
                }
            });
        };

        function RenderPage(pdf_container, num,size) {
            pdfDoc.getPage(num).then(function (page) {
                //Create Canvas element and append to the Container DIV.
                var canvas = document.createElement('canvas');
                canvas.id = 'pdf-' + num;
                ctx = canvas.getContext('2d');
                pdf_container.appendChild(canvas);

                //Create and add empty DIV to add SPACE between pages.
                var spacer = document.createElement("div");
                spacer.style.height = "20px";
                pdf_container.appendChild(spacer);

                //Set the Canvas dimensions using ViewPort and Scale.
                var viewport = page.getViewport({ scale: size });
                canvas.height = resolution * viewport.height;
                canvas.width = resolution * viewport.width;
                
                //Render the PDF page.
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport,
                    transform: [resolution, 0, 0, resolution, 0, 0]
                };
                
                page.render(renderContext);
            });
        };

        function IsMobile() {
            var r = new RegExp("Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini");
            return r.test(navigator.userAgent);
        }

        function zoomIn()
        {
            console.log(scale);
            if (scale > 2)
            {
                scale == 2;
            }
            else
            {
                scale = scale + 0.25;
            }
            
            LoadPdfFromUrl('<?php echo $files ?>',scale);
        }

        function zoomOut()
        {
            console.log(scale);
            if (scale < 0.5)
            {
                scale == 0.5;
            }
            else
            {
                scale = scale - 0.25;
            }
            
            LoadPdfFromUrl('<?php echo $files ?>',scale);
        }
    </script>
</body>
</html>