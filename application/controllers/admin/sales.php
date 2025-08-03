<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
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
    </style>
</head>
<body>
    <div class="container py-5 mt-5">
        <ul class="nav nav-tabs border-0 flex-row-reverse" id="myTab" role="tablist">
            <li class="col-3 text-end"><h2>سجل المبيعات</h2></li>
            <li class="nav-item me-5" role="presentation">
              <button class="btn rounded-pill active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                جرد يومي
            </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="btn rounded-pill " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                جرد اسبوعي
            </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="btn rounded-pill" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                جرد شهري
            </button>
            </li>
            
          </ul>
          <div class="tab-content d-flex justify-content-end" id="myTabContent">
            <div class="tab-pane fade col-9   show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
              <br> <table class="table col-9">
                    <thead>
                      <tr>
                        <th scope="col" class="text-end">التاريخ</th>
                        <th scope="col" class="text-end">السعر</th>
                        <th scope="col" class="text-end">العدد</th>
                        <th scope="col" class="text-end">اسم الخدمة</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-end">2024/11/12 </td>
                        <td class="text-end">79,000 IQD</td>
                        <td class="text-end">6</td>
                        <td class="text-end">تنظيف بشرة</td>
                      </tr>
                      <tr>
                        <td class="text-end">2024/11/12 </td>
                        <td class="text-end">79,000 IQD</td>
                        <td class="text-end">6</td>
                        <td class="text-end">تنظيف بشرة</td>
                      </tr>
                      <tr>
                        <td class="text-end">2024/11/12 </td>
                        <td class="text-end">79,000 IQD</td>
                        <td class="text-end">6</td>
                        <td class="text-end">تنظيف بشرة</td>
                      </tr>
                      <tr>
                        <td class="text-end">2024/11/12 </td>
                        <td class="text-end">79,000 IQD</td>
                        <td class="text-end">6</td>
                        <td class="text-end">تنظيف بشرة</td>
                      </tr>
                      <tr>
                        <td class="text-end">2024/11/12 </td>
                        <td class="text-end">79,000 IQD</td>
                        <td class="text-end">6</td>
                        <td class="text-end">تنظيف بشرة</td>
                      </tr>
                     
                  
                    </tbody>

                  </table><br>
                  <div class=" d-flex col-12 mt-5 border-top py-4">
                    <div class="col-6 text-start">79,000 IQD</div> 
                     <div class="col-6 text-end">الاجمالي</div>    
                     
                  </div>
            </div>
            <div class="tab-pane col-9  fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <!-- On tables --><br>
                <table class="table col-9">
                  <thead>
                    <tr>
                      <th scope="col" class="text-end">التاريخ</th>
                      <th scope="col" class="text-end">السعر</th>
                      <th scope="col" class="text-end">العدد</th>
                      <th scope="col" class="text-end">اسم الخدمة</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-end">2024/11/12 </td>
                      <td class="text-end">79,000 IQD</td>
                      <td class="text-end">6</td>
                      <td class="text-end">تنظيف بشرة</td>
                    </tr>
                    <tr>
                      <td class="text-end">2024/11/12 </td>
                      <td class="text-end">79,000 IQD</td>
                      <td class="text-end">6</td>
                      <td class="text-end">تنظيف بشرة</td>
                    </tr>
                    <tr>
                      <td class="text-end">2024/11/12 </td>
                      <td class="text-end">79,000 IQD</td>
                      <td class="text-end">6</td>
                      <td class="text-end">تنظيف بشرة</td>
                    </tr>
                    <tr>
                      <td class="text-end">2024/11/12 </td>
                      <td class="text-end">79,000 IQD</td>
                      <td class="text-end">6</td>
                      <td class="text-end">تنظيف بشرة</td>
                    </tr>
                   
                  </tbody>
                 
                </table><br>
                <div class=" d-flex col-12 mt-5 border-top py-4">
                  <div class="col-6 text-start">79,000 IQD</div> 
                   <div class="col-6 text-end">الاجمالي</div>    
                   
                </div>
            </div>
            <div class="tab-pane col-9  fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <!-- On tables --><br>
                <table class="table col-9">
                  <thead>
                    <tr>
                      <th scope="col" class="text-end">التاريخ</th>
                      <th scope="col" class="text-end">السعر</th>
                      <th scope="col" class="text-end">العدد</th>
                      <th scope="col" class="text-end">اسم الخدمة</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-end">2024/11/12 </td>
                      <td class="text-end">79,000 IQD</td>
                      <td class="text-end">6</td>
                      <td class="text-end">تنظيف بشرة</td>
                    </tr>
                    <tr>
                      <td class="text-end">2024/11/12 </td>
                      <td class="text-end">79,000 IQD</td>
                      <td class="text-end">6</td>
                      <td class="text-end">تنظيف بشرة</td>
                    </tr>
                    <tr>
                      <td class="text-end">2024/11/12 </td>
                      <td class="text-end">79,000 IQD</td>
                      <td class="text-end">6</td>
                      <td class="text-end">تنظيف بشرة</td>
                    </tr>
                    <tr>
                      <td class="text-end">2024/11/12 </td>
                      <td class="text-end">79,000 IQD</td>
                      <td class="text-end">6</td>
                      <td class="text-end">تنظيف بشرة</td>
                    </tr>
                   
                  </tbody>
                
                </table><br>
                <div class=" d-flex col-12 mt-5 border-top py-4">
                  <div class="col-6 text-start">79,000 IQD</div> 
                   <div class="col-6 text-end">الاجمالي</div>    
                   
                </div>
            </div>
           
          </div>
    </div>
   
    <!-- إضافة رابط Bootstrap و FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>