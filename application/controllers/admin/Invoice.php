<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج مع رفع صورة احترافي</title>
    <!-- إضافة رابط Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap');
*{
    font-family: "IBM Plex Sans Arabic", serif;
}
.bg{
    background: linear-gradient(#ffffff,#C7FBFF);
}
.number-container {
    display: flex;
    align-items: center;
    margin-left: 20px;
    font-size: 18px;
}

.number-container button {
   padding-inline: 5px;
    font-size: 18px;
    cursor: pointer;
    background-color: #0054c2;
    color: rgb(255, 255, 255);
    border: none;
    border-radius: 5px;
}

.number-container button:hover {
    background-color: #0084ff;
}

.number-container input {
    text-align: center;
    font-size: 18px;
    width: 40px;
    border: none;
    border-radius: 10px;
}     
        
        .file-upload-wrapper {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
            border: 1px solid #7979799d;
            padding: 40px;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .file-upload-wrapper:hover {
            border-color: #3b3b3b;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        .file-upload-icon {
            font-size: 3rem;
            color: #727272;
            margin-bottom: 15px;
        }
        .file-upload-text {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 10px;
            font-weight: bold;
        }
      
        .file-upload-btn:hover {
            background-color: #0056b3;
        }
        input[type="file"] {
            display: none;
        }
        #imagePreview {
            margin-top: 20px;
            display: none;
            text-align: center;
        }
        #imagePreview img {
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .image-container {
            margin-top: 20px;
        }
        .image-container h5 {
            color: #333;
            font-size: 1.2rem;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5 d-flex gap-4 justify-content-between">
    <div class="col-7 bg-light px-3 shadow rounded py-5">
        <h2 class="text-center mb-4">نموذج التسجيل مع رفع صورة</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
             <!-- حقل رفع الصورة -->
              <div class="col-12">
                <label for="file" class="form-label ms-3">الشعار </label>
                <div class="file-upload-wrapper">
                   <i class="file-upload-icon fas fa-cloud-upload-alt"></i>
                   <div class="file-upload-text">
                   <label for="formFile" class="fs-6 fw-light">
                       اسحب وافلت الصورة الخاصة بالشعار هنا او
                       <span class="text-primary text-decoration-underline">  قم بأختيار من مجلد لديك</span>
                   </label>
                   <input class="form-control" type="file" id="formFile" name="image" accept="image/*" onchange="showImagePreview(event)">
                   </div>
               </div>
              </div>
            
            <!-- حقل الاسم -->
            <div class="mb-3">
                <label for="name" class="form-label">اسم المجمع</label>
                <input type="text" class="form-control" placeholder="أدخل اسم المجمع">
            </div>

            <!-- حقل رقم الهاتف -->
            <div class="mb-3">
                <label for="tel" class="form-label">رقم الهاتف</label>
                <input type="tel" class="form-control"  placeholder=" أدخل رقم الهاتف">
            </div>
             <!-- حقل العنوان  -->
             <div class="mb-3">
                <label for="text" class="form-label"> العنوان</label>
                <input type="text" class="form-control"  placeholder=" أدخل  العنوان">
            </div>
            
            <div class="d-flex gap-3 px-5 justify-content-center py-4">
                 <!-- حقل رفع الصورة -->
             <div class="col-4 border rounded px-4 pt-4 text-center">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="40"  height="40"  viewBox="0 0 24 24"  fill="#757575"  class="icon icon-tabler icons-tabler-filled icon-tabler-file"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005h5z" /><path d="M19 7h-4l-.001 -4.001z" /></svg>
                <div class="file-upload-text">
                <label for="formFile" class="fs-6 fw-light">
                    ضع QR Code هنا      
                 </label>
                <input class="form-control" type="file" id="formFile" name="image" accept="image/*" onchange="showImagePreview(event)">
                </div>
             </div>
              <!-- حقل رفع الصورة -->
              <div class="col-4 border rounded px-4 pt-4 text-center">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="40"  height="40"  viewBox="0 0 24 24"  fill="#757575"  class="icon icon-tabler icons-tabler-filled icon-tabler-file"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005h5z" /><path d="M19 7h-4l-.001 -4.001z" /></svg>
                <div class="file-upload-text">
                <label for="formFile" class="fs-6 fw-light">
                    ضع QR Code هنا      
                 </label>
                <input class="form-control" type="file" id="formFile" name="image" accept="image/*" onchange="showImagePreview(event)">
                </div>
             </div>
             <div class="col-4 border rounded px-4 pt-4 text-center">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="40"  height="40"  viewBox="0 0 24 24"  fill="#757575"  class="icon icon-tabler icons-tabler-filled icon-tabler-file"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005h5z" /><path d="M19 7h-4l-.001 -4.001z" /></svg>
                <div class="file-upload-text">
                <label for="formFile" class="fs-6 fw-light">
                    ضع QR Code هنا      
                 </label>
                <input class="form-control" type="file" id="formFile" name="image" accept="image/*" onchange="showImagePreview(event)">
                </div>
             </div>

            </div>
           
        </form>
    </div>
    <div class="col-5 rounded border shadow px-3">
        <div class="col-12 py-3 d-flex justify-content-center overflow-hidden border-bottom">
            <div class="px-5 py-5 rounded-circle bg-dark text-white">
             الشعار
            </div>
        </div>
        <div class="col-12 border-bottom py-3">
            <h2 class="text-center fs-4">
                اسم المجمع
            </h2>
        </div>
        <div class="col-12 d-flex flex-wrap flex-row-reverse py-3">
            <div class="col-6 p">
                <h6 class="text-end">: رقم الفاتورة</h6>
            </div>
            <div class="col-6">
                <h6 class="text-end">   : التاريخ</h6>
             </div>
            <div class="col-12 py-3">
                <h6 class="text-end">: اسم المريض</h6>
            </div>

        </div>
        <div class="col-12 py-4">
            <table class="table">
                <thead>
                  <tr >
                    <th scope="col">السعر</th>
                    <th scope="col">عدد</th>
                    <th scope="col">اسم الدكتور</th>
                    <th scope="col">اسم</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td>Otto</td>
                  </tr>
                  <tr>
                    <td>Jacob</td>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>Thornton</td>
                   
                   
                  </tr>
                 
                </tbody>
                <tfoot>
                    <th colspan="4" class="text-end">: الاجمالي</th>
                </tfoot>
              </table>
        </div>
        <div class="col-12 d-flex justify-content-center px-4  py-3">
          <div class="col-4 d-flex flex-column ">
             <img src="../img/qr.png" width="120">
             <div class="d-flex justify-content-center py-2">
                <div class="col-4 px-2 ms- py-2 rounded-circle bg-dark">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#ffff"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-tiktok"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 7.917v4.034a9.948 9.948 0 0 1 -5 -1.951v4.5a6.5 6.5 0 1 1 -8 -6.326v4.326a2.5 2.5 0 1 0 4 2v-11.5h4.083a6.005 6.005 0 0 0 4.917 4.917z" /></svg>
                 </div>
             </div>
             
        </div>
          <div class="col-4 d-flex flex-column ms-2">
            <img src="../img/qr.png" width="120">
              <div class="d-flex justify-content-center py-2">
                <div class="col-4 px-2 ms- py-2 rounded-circle bg-dark">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#ffff"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
                     </div>
             </div>
             
         </div>
         <div class="col-4 d-flex flex-column ms-2">
            <img src="../img/qr.png" width="120">
              <div class="d-flex justify-content-center py-2">
                <div class="col-4 px-2 ms- py-2 rounded-circle bg-dark">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#ffff"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M16.5 7.5v.01" /></svg>                 </div>
             </div>
             
         </div>
        </div>
        
    </div>
</div>

<!-- إضافة رابط Bootstrap و FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
