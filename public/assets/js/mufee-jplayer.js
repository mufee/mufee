var nowms;
var nextms;
function loadJPlayer() {
    $('#jquery_jplayer_1').jPlayer({
        ready: function() {
            nowms = mdata.pop();
            nextms = mdata.pop();
            $(this).jPlayer('volume', 0.5)
                    .jPlayer('setMedia', {mp3: "/uploadmusic/" + nowms["savename"]})
                    .jPlayer('play');
            $("#artist").replaceWith("<a id='artist' target='blank' href='/artist/view?id=" + nowms["artistid"] + "'>"
                    + "<img src='/uploadthumbnail/" + nowms['thumbnailname'] + "' class='nowimg img-polaroid' id='nowimg'></a>");
            $("#nextcd").replaceWith("<div id='nextcd'><img src='/uploadthumbnail/" + nextms['thumbnailname'] + "' class='nextimg img-polaroid-cd' id='nextimg'><img src='/icon/cd2.png' class='cd'></div>");
            document.getElementById("title").innerText = nowms["title"];
            document.getElementById("artistname").innerText = nowms["username"];
            if (nowms["lyrics"] === "") {
                document.getElementById("lyrics").innerText = "この曲の歌詞情報はありません"
            } else {
                document.getElementById("lyrics").innerText = nowms["lyrics"]
            }
            $(musicoperate(nowms["savename"]));
        },
        ended: function(event) {
            if (nextms === 0) {
                location.href = window.location.href;
            } else {
                $(nextMusic);
            }
        },
        swfPath: '../swf',
        supplied: 'mp3',
        cssSelectorAncestor: '#jp_interface_1',
    });
    $('#nextbtn').click(function() {
        if (nextms === 0) {
            location.href = window.location.href;
        } else {
            $(nextMusic);
        }
    });
}

function nextMusic() {
    $('#nextcd').animate({right: '300px',rotate: '-=1500deg',opacity: 0}, {duration: 3000, easing: 'easeOutQuad', complete:
                function() {
                    nowms = nextms;
                    $('#jquery_jplayer_1').jPlayer('setMedia', {mp3: "/uploadmusic/" + nowms["savename"]})
                            .jPlayer('play');
                    $("#artist").replaceWith("<a id='artist' target='blank' href='/artist/view?id=" + nowms["artistid"] + "'>"
                            + "<img src='/uploadthumbnail/" + nowms['thumbnailname'] + "' class='nowimg img-polaroid' id='nowimg'></a>");
                    $("#nowimg").hide();
                    $("#nowimg").fadeIn(2000);
                    if (mdata.length > 0) {
                        nextms = mdata.pop();
                        $("#nextcd").replaceWith("<div id='nextcd'><img src='/uploadthumbnail/" + nextms['thumbnailname'] + "' class='nextimg img-polaroid-cd' id='nextimg'><img src='/icon/cd2.png' class='cd'></div>");
                    } else if (mdata.length <= 0) {
                        $("#nextcd").replaceWith("<div id='nextcd'><img src='/uploadthumbnail/none_image.jpg' class='nextimg img-polaroid-cd' id='nextimg'><img src='/icon/cd2.png' class='cd'></div>");
                        nextms = 0;
                    }
                    $("#nextcd").hide();
                    $("#nextcd").fadeIn(2000);
                    $('#nextbtn').click(function() {
                        if (nextms === 0) {
                            location.href = window.location.href;
                        } else {
                            $(nextMusic);
                        }
                    });
                    document.getElementById("title").innerText = nowms["title"];
                    document.getElementById("artistname").innerText = nowms["username"];
                    if (nowms["lyrics"] === "") {
                        document.getElementById("lyrics").innerText = "この曲の歌詞情報はありません"
                    } else {
                        document.getElementById("lyrics").innerText = nowms["lyrics"]
                    }
                    $(musicoperate(nowms["savename"]));

                }
    });
}

function musicoperate(name) {
    $.ajax({
        type: "POST",
        url: "/ajax/musicoperate",
        data: {"name": name},
        success: function()
        {
        },
        error: function() {
        }
    });
}
