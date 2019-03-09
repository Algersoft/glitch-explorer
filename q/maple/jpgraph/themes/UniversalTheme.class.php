<?php

/**
* Universal Theme class
*/
class UniversalTheme extends Theme 
{
    private $font_color       = '#aaaaaa';
    private $background_color = '#282d31';
    private $axis_color       = '#aaaaaa';
    private $grid_color       = '#282d31';

    function GetColorList() {
        return array(
            '#61a9f3',#blue
            '#f381b9',#red
            '#61E3A9',#green

            #'#D56DE2',
            '#85eD82',
            '#F7b7b7',
            '#CFDF49',
            '#88d8f2',
            '#07AF7B',
            '#B9E3F9',
            '#FFF3AD',
            '#EF606A',
            '#EC8833',
            '#FFF100',
            '#87C9A5',
        );
    }

    function SetupGraph($graph) {

        // graph
        /*
        $img = $graph->img;
        $height = $img->height;
        $graph->SetMargin($img->left_margin, $img->right_margin, $img->top_margin, $height * 0.25);
        */
        $graph->SetFrame(false);
        $graph->SetMarginColor('black');
        $graph->SetBox(true, 'black');
//        $graph->SetBackgroundGradient($this->background_color, '#FFFFFF', GRAD_HOR, BGRAD_PLOT);

        // legend
        $graph->legend->SetFrameWeight(0);
        $graph->legend->Pos(0.5, 0.85, 'center', 'top');
        $graph->legend->SetFillColor('#282d31');
        $graph->legend->SetLayout(LEGEND_HOR);
        $graph->legend->SetColumns(3);
        $graph->legend->SetShadow(false);
        $graph->legend->SetMarkAbsSize(5);

        // xaxis
        $graph->xaxis->title->SetColor($this->font_color);  
        $graph->xaxis->SetColor($this->axis_color, $this->font_color);    
        $graph->xaxis->SetTickSide(SIDE_BOTTOM);
        $graph->xaxis->SetLabelMargin(10);
        $graph->xaxis->HideTicks();
        $graph->xaxis->SetTitleMargin(15);
        //$graph->xaxis->SetLabelMargin(30);
                
        // yaxis
        $graph->yaxis->title->SetColor($this->font_color);  
        $graph->yaxis->SetColor($this->axis_color, $this->font_color);    
        $graph->yaxis->SetTickSide(SIDE_LEFT);
        $graph->yaxis->SetLabelMargin(8);
//        $graph->yaxis->SetTickPositions(array(50, 100, 150));
//        $graph->yaxis->HideLine();
        $graph->yaxis->HideTicks();

        // grid
        $graph->ygrid->SetColor($this->grid_color);
        $graph->ygrid->SetFill(true, '#282d31', $this->background_color);
 //       $graph->ygrid->SetLineStyle('dotted');


        // font
        $graph->title->SetColor($this->font_color);
        $graph->subtitle->SetColor($this->font_color);
        $graph->subsubtitle->SetColor($this->font_color);

        $graph->img->SetAntiAliasing();
    }


    function SetupPieGraph($graph) {

        // graph
        $graph->SetFrame(false);

        // legend
        $graph->legend->SetFillColor('white');

        $graph->legend->SetFrameWeight(0);
        $graph->legend->Pos(0.5, 0.80, 'center', 'top');
        $graph->legend->SetLayout(LEGEND_HOR);
        $graph->legend->SetColumns(4);

        $graph->legend->SetShadow(false);
        $graph->legend->SetMarkAbsSize(5);

        // title
        $graph->title->SetColor($this->font_color);
        $graph->subtitle->SetColor($this->font_color);
        $graph->subsubtitle->SetColor($this->font_color);

        $graph->SetAntiAliasing();
    }


    function PreStrokeApply($graph) {
        if ($graph->legend->HasItems()) {
            $img = $graph->img;
            $graph->SetMargin(
                $img->raw_left_margin, 
                $img->raw_right_margin, 
                $img->raw_top_margin, 
                is_numeric($img->raw_bottom_margin) ? $img->raw_bottom_margin : $img->height * 0.25
            );
        }
    }

    function ApplyPlot($plot) {

        switch (get_class($plot))
        { 
            case 'GroupBarPlot':
            {
                foreach ($plot->plots as $_plot) {
                    $this->ApplyPlot($_plot);
                }
                break;
            }

            case 'AccBarPlot':
            {
                foreach ($plot->plots as $_plot) {
                    $this->ApplyPlot($_plot);
                }
                break;
            }

            case 'BarPlot':
            {
                $plot->Clear();

                $color = $this->GetNextColor();
                $plot->SetColor($color);
                $plot->SetFillColor($color);
                $plot->SetShadow('red', 3, 4, false);
                break;
            }

            case 'LinePlot':
            {
                $plot->Clear();
                $plot->SetColor($this->GetNextColor().'@0.4');
                $plot->SetWeight(2);
                break;
            }

            case 'PiePlot':
            {
                $plot->SetCenter(0.5, 0.45);
                $plot->ShowBorder(false);
                $plot->SetSliceColors($this->GetThemeColors());
                break;
            }

            case 'PiePlot3D':
            {
                $plot->SetSliceColors($this->GetThemeColors());
                break;
            }
    
            default:
            {
            }
        }
    }
}


?>
