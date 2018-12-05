var koliko=0;
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$("#select-artikla").change(function () {
    var sell = $(".select-art:selected");
    var mj = sell.data("mjjd");
    var mjid = sell.data("mjid");
    var mjdug = sell.data("dugamj");
    var sel = $("#mjernajedtext");
    sel.html(mj);
    sel.data("mjid", mjid);
    sel.attr("data-original-title", mjdug);

    var stp = sell.data("steps");
	$("#idkolicine").val("").attr("step", stp);
	$("#cijenaa").val("");
});

// var dtmun = $("#datumun");
// dtmun.focus(function () {
//     $(this).attr("type", "date");
// });
/*
var dtmun2 = $("#datumunskl");
dtmun2.focus(function () {
    $(this).attr("type", "date");
});
*/
/*
dtmun.blur(function () {
    var dtmun1=new Date($("#datumun").val());
    var day=dtmun1.getDate();
    var month=dtmun1.getMonth();
    var year=dtmun1.getFullYear();
    $(this).attr("type","text");
    $(this).val(day+"."+month+"."+year+".");
});
*/

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#formica").on("submit", function (e) {
    e.preventDefault();
    var sr=$(this).serialize();
    var btn=$("#formica button[type=submit]");
    btn.attr("disabled","disabled");
    $("#alrt-dobar").slideUp(function () {
        $("#kojijedodan").html("");
    });
    $("#alrtgrska").slideUp(function () {
        $("#ajaksresp").html("");
    });
	$("html, body").animate({ scrollTop: 330 });
    $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        data: sr,
        success: function (data) {
            $("#kojijedodan").html($("#select-artikla option:selected").html() + " · " + $("#idkolicine").val() + " " + $("#mjernajedtext").html() + " · " + $("#cijenaa").val() + " KM · " + $("#datumun").val());
            btn.removeAttr("disabled");
            $("#ajaksresp").html(data);
            $("#alrt-dobar").slideDown();
            $(".alrtrfs:not(#nemojovaj)").show();
        },
        error: function (xhr, data) {
            btn.removeAttr("disabled");
            $("#greskadodavanja").html(data);
            $("#alrtgrska").slideDown();
        }
    });
    return false;
});


$("#formica2").on("submit", function (e) {
	e.preventDefault();
	$("#kojijedodan").html("");
	$("#ajaksresp").html("");
	var btn=$("#formica2 button[type=submit]");
	btn.attr("disabled","disabled");
	$("html, body").animate({ scrollTop: 310 });
	$.ajax({
		url: $(this).attr("action"),
		type: $(this).attr("method"),
		data: $(this).serialize(),
		success: function (data) {
			$("#kojijedodan").html($("#imee").val() + " · " + $("#cjna").val() + " KM");
			btn.removeAttr("disabled");
			$("#ajaksresp").html(data);
			$("#alrt-dobar").slideDown();
			$(".alrtrfs").show();
		},
		error: function (xhr, data) {
			btn.removeAttr("disabled");
			$("#greskadodavanja").html(data);
			$("#alrtgrska").slideDown();
		}
	});
	return false;
});

$("#formica2d").on("submit", function (e) {
	e.preventDefault();
	$("#kojijedodan").html("");
	$("#ajaksresp").html("");
	var btn=$("#formica2d button[type=submit]");
	btn.attr("disabled","disabled");
	$("html, body").animate({ scrollTop: 310 });
	$.ajax({
		url: $(this).attr("action"),
		type: $(this).attr("method"),
		data: $(this).serialize(),
		success: function (data) {
			$("#kojijedodan").html($("#imeed").val() + " · " + $("#opisd").val());
			btn.removeAttr("disabled");
			$("#ajaksresp").html(data);
			$("#alrt-dobar").slideDown();
			$(".alrtrfs").show();
		},
		error: function (xhr, data) {
			btn.removeAttr("disabled");
			$("#greskadodavanja").html(data);
			$("#alrtgrska").slideDown();
		}
	});
	return false;
});

$("#formica2dd").on("submit", function (e) {
	e.preventDefault();
	$("#kojijedodan").html("");
	$("#ajaksresp").html("");
	var btn=$("#formica2dd button[type=submit]");
	btn.attr("disabled","disabled");
	$("html, body").animate({ scrollTop: 310 });
	$.ajax({
		url: $(this).attr("action"),
		type: $(this).attr("method"),
		data: $(this).serialize(),
		success: function (data) {
			$("#kojijedodan").html($("#imeed").val() + " · " + $("#opisd option:selected").data("ime"));
			btn.removeAttr("disabled");
			$("#ajaksresp").html(data);
			$("#alrt-dobar").slideDown();
			$(".alrtrfs").show();
		},
		error: function (xhr, data) {
			btn.removeAttr("disabled");
			$("#greskadodavanja").html(data);
			$("#alrtgrska").slideDown();
		}
	});
	return false;
});


$(".closee").click(function () {
    $(this).parent().slideUp();
});

$("#hmm").on("submit", function (e) {
    e.preventDefault();
    var sr=$(this).serialize();
    var btn=$("#hmm button[type=submit]");
    btn.attr("disabled","disabled");
    $("#alrt-dobarmd").slideUp(function () {
        $("#kojijedodanmd").html("");
    });
    $("#alrtgrskamd").slideUp(function () {
        $("#ajaksrespmd").html("");
    });
	$("html, body").animate({ scrollTop: 310 });
    $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        data: sr,
        success: function (data) {
            $("#kojijedodanmd").html($("#artkl").val() + " · " + $("#mjdnica option:selected").data("ime"));
            btn.removeAttr("disabled");
            $(".alrtrfs:not(#alrtskl)").slideDown();
            $("#ajaksrespmd").html(data);
            $("#alrt-dobarmd").slideDown();
        },
        error: function (xhr, data) {
            btn.removeAttr("disabled");
            $("#greskadodavanjamd").html(data);
            $("#alrtgrskamd").slideDown();
        }
    });
    return false;
});

$(".rstbtn").click(function () {
    var id = $(this).data("idzab");
    var s=$(".rstred[data-redidzab=" + id + "]");
    $(this).attr("disabled","disabled");
    $.ajax({
        url: "/raskl",
        type: "post",
        data: "ide="+id,
        success: function (data) {
            s.html("<td colspan='4' class='font-italic text-muted text-center'>" + data + " · uspješno rasklopljeno</td>");
            $(".alrtrfs").slideDown();
        },
        error: function (xhr, data) {
            s.html("<td colspan='4' class='font-italic text-danger text-center'>Greška: "+data+"</td>");
        }
    });
});

$(".rstbtndb").click(function () {
	var id = $(this).data("idzab");
	var s=$(".rstredd[data-redidzab=" + id + "]");
	$(this).attr("disabled","disabled");
	$.ajax({
		url: "/raskld",
		type: "post",
		data: "ide="+id,
		success: function (data) {
			s.html("<td colspan='4' class='font-italic text-muted text-center'>" + data + " · uspješno izbrisano</td>");
			$(".alrtrfs").slideDown();
		},
		error: function (xhr, data) {
			s.html("<td colspan='4' class='font-italic text-danger text-center'>Greška: "+data+"</td>");
		}
	});
});


$(".rstbtndbd").click(function () {
	var id = $(this).data("idzab");
	var s=$(".rstredd[data-redidzab=" + id + "]");
	$(this).attr("disabled","disabled");
	$.ajax({
		url: "/raskldd",
		type: "post",
		data: "ide="+id,
		success: function (data) {
			s.html("<td colspan='4' class='font-italic text-muted text-center'>" + data + " · uspješno izbrisano</td>");
			$(".alrtrfs").slideDown();
		},
		error: function (xhr, data) {
			s.html("<td colspan='4' class='font-italic text-danger text-center'>Greška: "+data+"</td>");
		}
	});
});



$(".zabr").click(function (e) {
	//e.preventDefault();
	var id = $(this).data("idb");
	var s=$(".rstreddd[data-maid=" + id + "]");
	var dd=s.data("namee");
	$(this).attr("disabled","disabled");
	$.ajax({
		url: "/rasklddd",
		type: "post",
		data: "ide="+id,
		success: function (data) {
			if(data==="Izbb"){
				s.html("<td colspan='9' class='font-italic text-muted text-center'>" + dd + " · uspješno izbrisano</td>");
				$(".alrtrfs").slideDown();
			}
		},
		error: function (xhr, data) {
			s.html("<td colspan='9' class='font-italic text-danger text-center'>Greška: "+data+"</td>");
		}
	});
	return false;
});


$("#formicaaa").on("submit", function (e) {
    e.preventDefault();
    var btn=$("#formicaaa button[type=submit]");
    btn.attr("disabled","disabled");
    $("#alrt-dobarskl").slideUp(function () {
        $("#kojijedodanskl").html("");
    });
    $("#alrtgrskaskl").slideUp(function () {
        $("#ajaksrespskl").html("");
    });
	$("html, body").animate({ scrollTop: 310 });
    $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        data: $(this).serialize(),
        success: function (data) {
            $("#kojijedodanskl").html($("#select-artiklaskl option:selected").html() + " · " + $("#idkolicineskl").val() + " " + $("#mjernajedtextskl").val() + " · " + $("#datumunskl").val());
            btn.removeAttr("disabled");
            $("#ajaksrespskl").html(data);
            $("#alrt-dobarskl").slideDown();
            $(".alrtrfs:not(#alrtskl)").show();
        },
        error: function (xhr, data) {
            btn.removeAttr("disabled");
            $("#greskadodavanjaskl").html(data);
            $("#alrtgrskaskl").slideDown();
        }
    });
    return false;
});

$("#stanjefilter").submit(function(e){
	e.preventDefault();
	var btn=$("#stanjefilter button[type=submit]");
	btn.attr("disabled","disabled");
	var poc=$("#pocetakdate").val();
	var kra=$("#krajdate").val();
	if(poc=="") poc="sve";
	if(kra=="") kra="sve";
	window.location.href=window.location.origin+"/stanje/"+poc+"/"+kra;
	btn.removeAttr("disabled");
	return false;
});

$(".klick").click(function(){
	var id=$(this).data("idd");
	var name=$(this).data("namee");
	var m=$("#sveoart").modal();
	$("#option2").prop("checked",true);
	$(".dates").val("");
	$(".clss").removeClass("active");
	$("#klasiraj").addClass("active");
	$('#sveoLabel').html("<span class='fas fa-file-signature'></span> "+name);
	var rs=$("#sveoartrespns");
	$("#grupabtnn").hide();
	rs.html("<h1 class=\"text-center\"><span class=\"fas fa-sync-alt fa-fw fa-spin\"></span></h1>");
	$.ajax({
		url: "/jedanart",
		type: "post",
		data: {id:id,od:"0001-01-01",ddo:"9999-12-31",at:"o2"},
		success: function (data) {
			rs.slideUp('fast',function(){
				rs.html(data);
				$('[data-toggle="tooltip"]').tooltip();
				$("#grupabtnn").slideDown();
				rs.slideDown();
			});
		},
		error: function (xhr, data) {

			rs.html("Error: "+data);
		}
	});
});

$("input[name=options], .dates").change(function(){
	var id=$("#ideideide").val();
	var at=$("input[name=options]:checked").data("op");
	var od=$(".dates[data-odildo=od]").val();
	var ddo=$(".dates[data-odildo=do]").val();
	if(od==="") od="0001-01-01";
	if(ddo==="") ddo="9999-12-31";
	var rs=$("#sveoartrespns");
	var bnm=$(".zareddi");
	rs.slideUp();
	$.ajax({
		url: "/jedanart",
		type: "post",
		data: {id:id,od:od,ddo:ddo,at:at},
		success: function (data) {
				rs.html(data);
				$('[data-toggle="tooltip"]').tooltip();
				$("#grupabtnn").slideDown();
				rs.slideDown();
			/*
			rs.slideUp(function(){
				bnm.hide();
				var p=bnm.filter(function(){
					return $(this).data("date")>=od && $(this).data("date")<=ddo;
				});
				p.show();
				$("#stavizb").html($("#zbir").val());
				if(at==="o1"){
					$("#arttbl tr.izl").hide();
					$("#stavizb").html($("#zbiru").val());
				}
				else if(at==="o3"){
					$("#arttbl tr.nenee").hide();
					$("#stavizb").html($("#zbiri").val());
				}

				rs.slideDown();
			});
			*/
		},
		error: function (xhr, data) {

			rs.html("Error: "+data);
		}
	});

});

$(document).on("change",".jqqq",function(){
	var t=$(this);
	var jel=t.data("jel");
	if(jel=="0"){
		$(".zadodatt").append($("#sakriveno").html());
		koliko++;
		$(".zadodatt>div").last().attr("data-hash",koliko);
		t.data("jel",1).data("nekrd",koliko);
		$("div[data-hash="+koliko+"] .jqqq").attr("data-rdbrin",koliko).attr("name","artical"+koliko);
		$("div[data-hash="+koliko+"] .klcn").attr("data-rdbrin",koliko).attr("name","k"+koliko);
		$("div[data-hash="+koliko+"] .mjernajedtext").attr("data-rdbrin",koliko);
		$("div[data-hash="+koliko+"] .brbtnspan").attr("data-kojiije",koliko);
		$("#ukol").val(koliko);
		$("div[data-hash="+koliko+"]>div").slideDown();
		$('[data-toggle="tooltip"]').tooltip();
	}
	var khm=t.data("nekrd");
	var sell = $("option:selected", this);
	var mj = sell.data("mjjd");
	var mjid = sell.data("mjid");
	var mjdug = sell.data("dugamj");
	//alert(khm);
	var sel = $(".mjernajedtext[data-rdbrin="+(khm-1)+"]");
	sel.html(mj);
	sel.data("mjid", mjid);
	sel.attr("data-original-title", mjdug);

	var stp = sell.data("steps");
	//$("#idkolicine").val("").attr("step", stp);
	//$("#cijenaa").val("");
});

$(document).on("click",".brbtnspan",function(){
	var t=$(this);
	var kj=t.data("kojiije");
	$("div[data-hash="+kj+"]").slideUp(function(){
		$("div[data-hash="+kj+"]").remove();
	});
});

$(document).ready(function () {
	//var ba=new URL(window.location.href);
	$(".onozaactive[href='"+window.location.href+"']").addClass("active");
	$(".zadodatt").append($("#sakriveno").html());
	koliko++;
	$(".zadodatt>div").last().attr("data-hash",koliko);
	$("div[data-hash="+koliko+"] .jqqq").attr("data-rdbrin",koliko).attr("name","artical"+koliko);
	$("div[data-hash="+koliko+"] .klcn").attr("data-rdbrin",koliko).attr("name","k"+koliko);
	$("div[data-hash="+koliko+"] .mjernajedtext").attr("data-rdbrin",koliko);
	$("div[data-hash="+koliko+"] .brbtnspan").attr("data-kojiije",koliko);
	$("#ukol").val(koliko);
	$("div[data-hash="+koliko+"]>div").show();
	$('[data-toggle="tooltip"]').tooltip();
});