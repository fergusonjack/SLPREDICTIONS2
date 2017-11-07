$doc = new DOMDocument();
$doc.loadHTMLFile('https://www.ons.gov.uk/economy/inflationandpriceindices');

$html = $doc.getElementById("stand-out")
print_r($html);