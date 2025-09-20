<?php
//=============================================================================
// File:	ODOEX04.PHP
// Description: Example 1 for odometer graphs
// Created:	2002-02-22
// Author:      Johan Persson (johanp@aditus.nu)
// Version:	$Id$
// 
// Comment:
// Example file for odometer graph. This examples extends odoex03
// by 1) changing the indicator needle style and color 2) Introducing
// a half circle in the middle that is not affetced by the indicator bands.
//
// Copyright (C) 2002 Johan Persson. All rights reserved.
//=============================================================================
include ("../../src/jpgraph.php");
include ("../../src/jpgraph_odo.php");

//---------------------------------------------------------------------
// Create a new odometer graph (width=250, height=200 pixels)
//---------------------------------------------------------------------
$graph = new OdoGraph(250,200);
$graph->SetShadow();

//---------------------------------------------------------------------
// Specify title and subtitle using default fonts
// * Note each title may be multilines by using a '\n' as a line
// divider.
//---------------------------------------------------------------------
$graph->title->Set("Odometer title");
$graph->title->SetColor("white");
$graph->subtitle->Set("2002-02-13");
$graph->subtitle->SetColor("white");

//---------------------------------------------------------------------
// Specify caption.
// * (This is the text at the bottom of the graph.) The margins will
// automatically adjust to fit the height of the text. A caption
// may have multiple lines by including a '\n' character in the 
// string.
//---------------------------------------------------------------------
$graph->caption->Set("First caption row\n... second row");
$graph->caption->SetColor("white");

//---------------------------------------------------------------------
// Now we need to create an odometer to add to the graph.
// By default the scale will be 0 to 100
//---------------------------------------------------------------------
$odo = new Odometer(); 

//---------------------------------------------------------------------
// Set color indication 
//---------------------------------------------------------------------
$odo->AddIndication(0,50,"green");
$odo->AddIndication(50,80,"yellow");
$odo->AddIndication(80,100,"red");

//---------------------------------------------------------------------
// Set the center area that will not be affected by the color bands
//---------------------------------------------------------------------
$odo->SetCenterAreaWidth(0.4);  // Fraction of radius

//---------------------------------------------------------------------
// Adjust scale ticks to be shown at 10 steps interval and scale
// labels at every second tick
//---------------------------------------------------------------------
$odo->scale->SetTicks(10,2);

//---------------------------------------------------------------------
// Use a bold font for tick labels
//---------------------------------------------------------------------
$odo->scale->label->SetFont(FF_FONT1, FS_BOLD);

//---------------------------------------------------------------------
// Set display value for the odometer
//---------------------------------------------------------------------
$odo->needle->Set(69);

//---------------------------------------------------------------------
// Add drop shadow to indicator needle
//---------------------------------------------------------------------
$odo->needle->SetShadow();

//---------------------------------------------------------------------
// Add the odometer to the graph
//---------------------------------------------------------------------
$graph->Add($odo);

//---------------------------------------------------------------------
// ... and finally stroke and stream the image back to the browser
//---------------------------------------------------------------------
$graph->Stroke();

// EOF
?>