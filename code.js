
$(document).ready(function(){
  $("#buy").on("click change",function(){
    swal("Đã thêm mặt hàng này vào giỏ !", "Hãy kiểm tra giỏ hàng của bạn!", "success");
  });
});

function showPreview(event){
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("img_prv");
      preview.src = src;
    }
}

function printBill() {  
  var divContents = document.getElementById("printbill").innerHTML;  
  var printWindow = window.open('', '', 'height=600,width=1200');  
  printWindow.document.write('<html><head><title>Thông Tin Hóa Đơn</title>');  
  printWindow.document.write('</head><body >');  
  printWindow.document.write(divContents);  
  printWindow.document.write('</body></html>');  
  printWindow.document.close();  
  printWindow.print();  
}  
