(function() {
    //参考サイト : https://www.granfairs.com/blog/staff/jquery-date-control
    window.addEventListener('DOMContentLoaded', (event) => {
        function setChangeDay(year, month){
            // var year = date_year.value;
            // var month = date_month.value;
            //
            // if(year == ""){
            //     year = date_year.children[0].value;
            //     date_year.selectedIndex = 0;
            // }
            // if(month == ""){
            //     month = date_month.children[1].value;
            //     date_month.selectedIndex = 0;
            // }

            //月の最終日を配列へ
            var lastday = new Array('', 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

            //年計算 : うるう年(4で割り切れる)、うるう年ではない(100で割り切れる)、例外(400で割り切れる)
            if ((year % 4 === 0 && year % 100 !== 0) || year % 400 === 0){
                lastday[2] = 29; //2月の最終日が29日になるよう代入
            }
            return lastday[Number(month)];
        }

        Array.prototype.slice.call(document.querySelectorAll('.dateChange')).forEach( (o) => {

            //最初のセット

            // //一回だけのイベント
            // o.addEventListener("change", function f(e) {
            //     e.currentTarget.querySelector('.dateChangeYear').children[0].outerHTML = "";
            //     e.currentTarget.querySelector('.dateChangeMonth').children[0].outerHTML = "";
            //     this.removeEventListener('change', f);}
            // );


            o.addEventListener('change', (e) => {

                if(e.target.className == "dateChangeDay"){
                    return false;
                }

                //登録したイベントのターゲットを基点(currentTarget)に子要素の年月の値を取得
                var day = setChangeDay(
                    e.currentTarget.querySelector('.dateChangeYear').value,
                    e.currentTarget.querySelector('.dateChangeMonth').value
                );

                //日付の初期化
                var no = "";
                var concat_option = "";
                var d = e.currentTarget.querySelector('.dateChangeDay');
                var old_selected_no = d.value;

                d.innerHTML = "";
                concat_option += '<option value=""></option>';
                for (var i = 1; i <= day; i++) {
                    no = ("0" + i).slice(-2);
                    concat_option += '<option value="' + no + '">' + no + '</option>';
                }
                d.insertAdjacentHTML("beforeend",concat_option);
                d.selectedIndex = old_selected_no;

            }, false);
        });

    });
})();
