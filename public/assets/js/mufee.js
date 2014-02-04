//
//  mufee.js
//

//　テーブルリンク用
jQuery(function($) {
    //data-hrefの属性を持つtrを選択しclassにclickableを付加
    $('tr[data-href]').addClass('clickable')
            //クリックイベント
            .click(function(e) {
        //e.targetはクリックした要素自体、それがa要素以外であれば
        if (!$(e.target).is('a')) {
            //その要素の先祖要素で一番近いtrの
            //data-href属性の値に書かれているURLに遷移する
            window.location = $(e.target).closest('tr').data('href');
        }
    });
});

genre = new Array(5);
function addGenre(id) {
    if (genre[id - 1] == null || genre[id - 1] == undefined) {
        genre[id - 1] = "<input type='hidden' name='gb[]' value='" + id * 1000 + "' />";
    } else {
        genre[id - 1] = null;
    }
}
function play() {
    for (i = 0; i < genre.length; i++) {
        if (genre[i] != null || genre[i] != undefined) {
            $('#selectGenre').append(genre[i]);
        }
    }
    document.genreForm.submit();
}