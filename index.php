<!DOCTYPE html>
<html lang="tr">
<!--oncontextmenu="return false" sağ tuş engelleme html içinde--> 
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">
  <title>Kelime Oluştur</title>
	<style>
	body {
		margin: 0 auto;
		background-color: #fff;
		font-family: Verdana;
		font-size: 16px;
		font-weight: 600;
		text-aling: center;
	}
	img {
		max-width: 100%;
	}
	.select {
		padding: 6px;
		height: 50px;
		font-size: 18px;
		font-weight: 800;
	}
	textarea {
		width: 90%;
		height: 330px;
		background-color: #fbfcfd;
		border: 2px solid gray;
		border-radius: 4px;
		resize: none;
	}
	.btn {
		padding: 6px;
		font-size: 18px;
		font-weight: 800;
	</style>
	<script>
var hashMapResults = {},
  numOfKeywords = 0,
  doWork = !1,
  keywordsToQuery = new Array(),
  keywordsToQueryIndex = 0,
  queryflag = !1;
function StartJob() {
  if (0 == doWork) {
    (hashMapResults = {}), (numOfKeywords = 0), (keywordsToQuery = new Array()), (keywordsToQueryIndex = 0), (hashMapResults[""] = 1), (hashMapResults[" "] = 1), (hashMapResults["  "] = 1);
    var e = $("#input").val().split("\n"),
      r = 0;
    for (r = 0; r < e.length; r++) {
      keywordsToQuery[keywordsToQuery.length] = e[r];
      var o = 0;
      for (o = 0; o < 26; o++) {
        var a = String.fromCharCode(97 + o),
          s = e[r] + " " + a;
        (keywordsToQuery[keywordsToQuery.length] = s), (hashMapResults[s] = 1);
      }
    }
    (document.getElementById("input").value += "\r\n"), (doWork = !0), $("#startjob").val("DURDUR");
  } else (doWork = !1), alert("Durduruldu !"), $("#startjob").val("BAŞLAT");
}
function DoJob() {
  1 == doWork &&
    0 == queryflag &&
    (keywordsToQueryIndex < keywordsToQuery.length
      ? (QueryKeyword(keywordsToQuery[keywordsToQueryIndex]), keywordsToQueryIndex++)
      : 0 != numOfKeywords
      ? (alert("Done"), (doWork = !1), $("#startjob").val("BAŞLAT"))
      : (keywordsToQueryIndex = 0));
}
function QueryKeyword(e) {
  var r = e;
  queryflag = !0;
  var o = $("#engine").val();
  "google" == o &&
    $.ajax({
      url: "https://suggestqueries.google.com/complete/search",
      jsonp: "jsonp",
      dataType: "jsonp",
      data: { q: r, client: "chrome" },
      success: function (e) {
        var r = e[1],
          o = 0,
          a = "";
        for (o = 0; o < r.length; o++) {
          var s = CleanVal(r[o]);
          if (1 != hashMapResults[s]) {
            (hashMapResults[s] = 1), (a = a + CleanVal(r[o]) + "\r\n"), numOfKeywords++, (keywordsToQuery[keywordsToQuery.length] = s);
            var t = 0;
            for (t = 0; t < 26; t++) {
              var u = s + " " + String.fromCharCode(97 + t);
              (keywordsToQuery[keywordsToQuery.length] = u), (hashMapResults[u] = 1);
            }
          }
        }
        $("#numofkeywords").html(numOfKeywords), (document.getElementById("input").value += a);
        var n = document.getElementById("input");
        (n.scrollTop = n.scrollHeight), (queryflag = !1);
      },
    }),
    "bing" == o &&
      $.ajax({
        url: "https://api.bing.com/osjson.aspx?JsonType=callback&JsonCallback=?",
        jsonp: "jsonp",
        dataType: "jsonp",
        data: { Query: r, Market: "en-us" },
        success: function (e) {
          var r = e[1],
            o = 0,
            a = "";
          for (o = 0; o < r.length; o++) {
            var s = CleanVal(r[o]);
            if (1 != hashMapResults[s]) {
              (hashMapResults[s] = 1), (a = a + CleanVal(r[o]) + "\r\n"), numOfKeywords++, (keywordsToQuery[keywordsToQuery.length] = s);
              var t = 0;
              for (t = 0; t < 26; t++) {
                var u = s + " " + String.fromCharCode(97 + t);
                (keywordsToQuery[keywordsToQuery.length] = u), (hashMapResults[u] = 1);
              }
            }
          }
          $("#numofkeywords").html(numOfKeywords), (document.getElementById("input").value += a);
          var n = document.getElementById("input");
          (n.scrollTop = n.scrollHeight), (queryflag = !1);
        },
      }),
    "youtube" == o &&
      $.ajax({
        url: "https://suggestqueries.google.com/complete/search",
        jsonp: "jsonp",
        dataType: "jsonp",
        data: { q: r, client: "chrome", ds: "yt" },
        success: function (e) {
          var r = e[1],
            o = 0,
            a = "";
          for (o = 0; o < r.length; o++) {
            var s = CleanVal(r[o]);
            if (1 != hashMapResults[s]) {
              (hashMapResults[s] = 1), (a = a + CleanVal(r[o]) + "\r\n"), numOfKeywords++, (keywordsToQuery[keywordsToQuery.length] = s);
              var t = 0;
              for (t = 0; t < 26; t++) {
                var u = s + " " + String.fromCharCode(97 + t);
                (keywordsToQuery[keywordsToQuery.length] = u), (hashMapResults[u] = 1);
              }
            }
          }
          $("#numofkeywords").html(numOfKeywords), (document.getElementById("input").value += a);
          var n = document.getElementById("input");
          (n.scrollTop = n.scrollHeight), (queryflag = !1);
        },
      }),
    "yahoo" == o &&
      $.ajax({
        url: "https://search.yahoo.com/sugg/gossip/gossip-us-ura/",
        dataType: "jsonp",
        data: { command: r, nresults: "20", output: "jsonp" },
        success: function (e) {
          var r = [];
          $.each(e.gossip.results, function (e, o) {
            r.push(o.key);
          });
          var o = 0,
            a = "";
          for (o = 0; o < r.length; o++) {
            var s = CleanVal(r[o]);
            if (1 != hashMapResults[s]) {
              (hashMapResults[s] = 1), (a = a + CleanVal(r[o]) + "\r\n"), numOfKeywords++, (keywordsToQuery[keywordsToQuery.length] = s);
              var t = 0;
              for (t = 0; t < 26; t++) {
                var u = s + " " + String.fromCharCode(97 + t);
                (keywordsToQuery[keywordsToQuery.length] = u), (hashMapResults[u] = 1);
              }
            }
          }
          $("#numofkeywords").html(numOfKeywords), (document.getElementById("input").value += a);
          var n = document.getElementById("input");
          (n.scrollTop = n.scrollHeight), (queryflag = !1);
        },
      }),
    "amazon" == o &&
      $.ajax({
        url: "https://completion.amazon.com/search/complete",
        dataType: "jsonp",
        data: { q: r, method: "completion", "search-alias": "aps", mkt: "1" },
        success: function (e) {
          var r = e[1],
            o = 0,
            a = "";
          for (o = 0; o < r.length; o++) {
            var s = CleanVal(r[o]);
            if (1 != hashMapResults[s]) {
              (hashMapResults[s] = 1), (a = a + CleanVal(r[o]) + "\r\n"), numOfKeywords++, (keywordsToQuery[keywordsToQuery.length] = s);
              var t = 0;
              for (t = 0; t < 26; t++) {
                var u = s + " " + String.fromCharCode(97 + t);
                (keywordsToQuery[keywordsToQuery.length] = u), (hashMapResults[u] = 1);
              }
            }
          }
          $("#numofkeywords").html(numOfKeywords), (document.getElementById("input").value += a);
          var n = document.getElementById("input");
          (n.scrollTop = n.scrollHeight), (queryflag = !1);
        },
      }),
    "ebay" == o &&
      $.ajax({
        url: "https://autosug.ebay.com/autosug",
        dataType: "jsonp",
        data: { kwd: r, v: "jsonp", _dg: "1", sId: "0" },
        success: function (e) {
          if (e.res) {
            var r = e.res.sug,
              o = 0,
              a = "";
            for (o = 0; o < r.length; o++) {
              var s = CleanVal(r[o]);
              if (1 != hashMapResults[s]) {
                (hashMapResults[s] = 1), (a = a + CleanVal(r[o]) + "\r\n"), numOfKeywords++, (keywordsToQuery[keywordsToQuery.length] = s);
                var t = 0;
                for (t = 0; t < 26; t++) {
                  var u = s + " " + String.fromCharCode(97 + t);
                  (keywordsToQuery[keywordsToQuery.length] = u), (hashMapResults[u] = 1);
                }
              }
            }
            $("#numofkeywords").html(numOfKeywords), (document.getElementById("input").value += a);
            var n = document.getElementById("input");
            n.scrollTop = n.scrollHeight;
          }
          queryflag = !1;
        },
      });
}
function CleanVal(e) {
  var r = e;
  return (
    (r = (r = (r = (r = (r = (r = (r = (r = (r = (r = (r = (r = (r = (r = (r = r.replace("\\u003cb\\u003e", "")).replace("\\u003c\\/b\\u003e", "")).replace("\\u003c\\/b\\u003e", "")).replace("\\u003cb\\u003e", "")).replace(
      "\\u003c\\/b\\u003e",
      ""
    )).replace("\\u003cb\\u003e", "")).replace("\\u003cb\\u003e", "")).replace("\\u003c\\/b\\u003e", "")).replace("\\u0026amp;", "&")).replace("\\u003cb\\u003e", "")).replace("\\u0026", "")).replace("\\u0026#39;", "'")).replace(
      "#39;",
      "'"
    )).replace("\\u003c\\/b\\u003e", "")).replace("\\u2013", "2013")).length > 4 &&
      "http" == r.substring(0, 4) &&
      (r = ""),
    r
  );
}
function FormSubmit(e) {
  (doWork = !1), $("#startjob").val("BAŞLAT"), $("form").submit();
}
window.setInterval(DoJob, 750);

	</script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
	<center>
		<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAXAAAABECAYAAACYhW4wAAAABHNCSVQICAgIfAhkiAAAAAFzUkdCAK7OHOkAAAAEZ0FNQQAAsY8L/GEFAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAjoklEQVR4Xu2dC7xURRnAB8rsRVqK9rIygSztYWoCt8xUEFEp7WHkA7UUMhAUESXAVPKtSeDjAppgGWpllEiklkkYYlqRIAJmZiKEhZph2mOa/9z59p499+xld8931rs0/9/v/NidXfbcc87MN998r+lmHSYSiUQiTUf38G8kEolEmowowCORSKRJiQI8EolEmpQowCORSKRJiQI8EolEmpQowCORSKRJqTmM8O677zbf/va3zWc+8xnz6le/OrTWz29/+1vzy1/+0nzrW98yPXr0CK3GXHvttWb16tVm4MCBpnv3fPMMl3jHHXeYZ555xkyfPr3s98aPH2/e9KY3mX322Se01M+//vUv873vfc+85z3vMaeddlpoNeall14yJ510kvnYxz5mdtlll9BaP88++6yZO3eu+cIXvmAOO+yw0GrM2rVrzemnn+6fDdeUlz//+c/mlltuMZdcconp06dPaDXmV7/6lZk1a5Y/z2te85rQWj8PPfSQ+dnPfmauu+46s+2224ZWY2bPnm2WLVtmBg8ebF7xileE1vr5+c9/bp588knT2tpa1+/985//NF/60pfMgAEDzDvf+c7QWj/0xxtvvNEMHz7cHHDAAaHVmD/84Q9m0qRJ/v6+8Y1vDK3188c//tHceuut5hvf+IZ597vfHVqNueuuu8zNN99sDj/8cJWx/MADD5ilS5f6vpEcy9xv/gbum8ZYXrhwofnHP/5hvvnNb5pu3bqFT4wZO3asectb3mL22muv0FI/jNkf/OAH5r3vfa8ZPXp0aG1r/+IXv2g+8YlPlN3LemEsf/e73zXHHnus7+c1gwCvheOOOy680sMJb9u/f3/7wgsv+Pd///vf7ahRo/xrTU455ZSyv3/JkiX26quvDu/0+OhHP+qvSbjqqqvsfffdF97p4CYL++Y3v9kuXrw4tFg7YsQIu2nTpvBOh1WrVtm3vvWt9k9/+lNosXbYsGHhlR5uQrJ77723dQPTv6cvOMHmX2viJmw7dOjQ8K42LrroIrtixYrwTgeu0wlp6xSZ0GKtm+ztv//97/BOBydc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" alt="Anahtar Kelime Oluşturucu" title="Anahtar Kelime Oluşturucu" />	<br>
		Verilerin alınacağı yer:
		<select class="select" name="engine" id="engine">
			<optgroup label="Arama Motorları">
				<option value="google">Google</option>
				<option value="youtube">YouTube</option>
				<option value="bing">Bing</option>
				<option value="yahoo">Yahoo</option>
			</optgroup>
			<optgroup label="Alışveriş">
				<option value="amazon">Amazon</option>
				<option value="ebay">Ebay</option>
			</optgroup>			
		</select>
		<br><br>
		<textarea id="input"></textarea>	<br>
		<table>
			<tr>
				<td>Bulunan kelime sayısı:</td>
				<td><div id="numofkeywords" style="font-size:24px;color:red;">0</div></td>
			</tr>
		</table>	<br>
		<input id="startjob" onClick="StartJob();" class="btn" type="button" value="BAŞLAT / DURDUR" />
		<input id="save" class="btn" type="button" value="TXT ÇIKTI AL" />
	</center>
	<script>
function saveTextAsFile() {
  var e = document.getElementById("input").value,
    t = new Blob([e], { type: "text/plain" }),
    n = document.createElement("a");
  (n.download = "anahtar-kelimeler.txt"),
    (n.innerHTML = "Download File"),
    null != window.webkitURL ? (n.href = window.webkitURL.createObjectURL(t)) : ((n.href = window.URL.createObjectURL(t)), (n.onclick = destroyClickedElement), (n.style.display = "none"), document.body.appendChild(n)),
    n.click();
}
var button = document.getElementById("save");
button.addEventListener("click", saveTextAsFile);

	</script>
</body>
</html>
