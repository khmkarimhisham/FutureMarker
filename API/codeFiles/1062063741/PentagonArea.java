
/*
 * The Program Computes the area Of a pentagon by 
 * inputting the length from the center
 *  of a pentagon to a vertex ( The Raduis ).
 * @ Author : Eslam Amin Ahmed
 * @ ID : 220180011 
 * @ version : 1.0 
 * 
 */
package ProgammingAssignment;

import java.util.Scanner;

public class PentagonArea {

	public static void main(String[] args) {
		Scanner input = new Scanner(System.in);
		double r, s, Area;
		double PI = Math.PI;
		System.out.print("Enter The Radius :");
		// the user inputs the length from the center of a pentagon to a vertex.
		r = input.nextDouble();
		// computes the length of a side
		s = (2 * r) * Math.asin(PI / 5);
		// computes the area
		Area = 5 * Math.pow(s, 2) / (4 * Math.atan(PI / 5));
		System.out.printf("%.2f", Area);

		input.close();
	}

}