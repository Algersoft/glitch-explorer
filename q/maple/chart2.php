<?php
require_once ('jpgraph2/jpgraph.php');
require_once ('jpgraph2/jpgraph_line.php');

$datay1 = json_decode(file_get_contents('prices.txt'), true);

// Setup the graph
$graph = new Graph(681,231);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(true);
$graph->SetBox(false);

$graph->SetMargin(40,5,10,10);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->SetColor("#555");
$graph->xaxis->SetColor("#555");
$graph->yaxis->HideTicks(false,false);

$graph->SetColor("#111");
$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xgrid->SetColor('#111');



$graph->SetMarginColor('#111');
$graph->SetFrame(true,'#111', 0);

// Create the first line
$p1 = new LinePlot($datay1);
$graph->Add($p1);
$p1->SetColor("orange");
//$p1->SetFillGradient('#663202','#111111');

// Output line
$graph->Stroke();


