@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container-fluit">
    <h1>Home</h1>

    <div class="row my-5">
        <div class="col-md-8 col-lg-8 col-xl-8 mb-4">
            <h4>Lorem Ipsum là gì?</h4>
            <p>
                Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker.
            </p>
        </div>

        <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
            <img src="https://xwatch.vn/upload_images/images/2023/03/29/anh-chill-cay-coi.jpg" class="img-thumbnail" alt="...">
        </div>
    </div>

    <div class="row my-5">
        <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
            <img src="https://khoinguonsangtao.vn/wp-content/uploads/2022/09/hinh-nen-cay-co-va-suong.jpg" class="img-thumbnail" alt="...">
        </div>

        <div class="col-md-8 col-lg-8 col-xl-8 mb-4">
            <h4>Tại sao lại sử dụng nó?</h4>
            <p>
                Chúng ta vẫn biết rằng, làm việc với một đoạn văn bản dễ đọc và rõ nghĩa dễ gây rối trí và cản trở việc tập trung vào yếu tố trình bày văn bản. Lorem Ipsum có ưu điểm hơn so với đoạn văn bản chỉ gồm nội dung kiểu "Nội dung, nội dung, nội dung" là nó khiến văn bản giống thật hơn, bình thường hơn. Nhiều phần mềm thiết kế giao diện web và dàn trang ngày nay đã sử dụng Lorem Ipsum làm đoạn văn bản giả, và nếu bạn thử tìm các đoạn "Lorem ipsum" trên mạng thì sẽ khám phá ra nhiều trang web hiện vẫn đang trong quá trình xây dựng. Có nhiều phiên bản khác nhau đã xuất hiện, đôi khi do vô tình, nhiều khi do cố ý (xen thêm vào những câu hài hước hay thông tục).
            </p>
        </div>
    </div>

    <hr />

    <div class="row my-5">
        <div class="col-md-8 col-lg-8 col-xl-8 mb-4">
            <h4>Image</h4>
            <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                    <img src="https://khoinguonsangtao.vn/wp-content/uploads/2022/09/hinh-nen-cay-co-va-suong.jpg" class="img-thumbnail" alt="...">
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                    <img src="https://khoinguonsangtao.vn/wp-content/uploads/2022/09/hinh-nen-cay-co-va-suong.jpg" class="img-thumbnail" alt="...">
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                    <img src="https://khoinguonsangtao.vn/wp-content/uploads/2022/09/hinh-nen-cay-co-va-suong.jpg" class="img-thumbnail" alt="...">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                    <img src="https://khoinguonsangtao.vn/wp-content/uploads/2022/09/hinh-nen-cay-co-va-suong.jpg" class="img-thumbnail" alt="...">
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                    <img src="https://khoinguonsangtao.vn/wp-content/uploads/2022/09/hinh-nen-cay-co-va-suong.jpg" class="img-thumbnail" alt="...">
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
                    <img src="https://khoinguonsangtao.vn/wp-content/uploads/2022/09/hinh-nen-cay-co-va-suong.jpg" class="img-thumbnail" alt="...">
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 col-xl-4 mb-4">
            <h4>Direct</h4>
            <ul>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Category</a></li>
                <li><a href="#">Product</a></li>
                <li><a href="#">Unit</a></li>
                <li><a href="#">Transaction</a></li>
                <li><a href="#">Report</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function () {

    });
</script>
@endpush
