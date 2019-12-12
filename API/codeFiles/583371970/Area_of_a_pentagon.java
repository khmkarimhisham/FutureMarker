package Prog.lang.Assignment;

/*
 * Write a program that prompts the user to enter
the length from the center of a pentagon to a vertex and computes the area of the
pentagon, as shown in the attached figure.
*Aouther:-Abanoub Maher Latif
*ID:-220 180 852
*project name:-compute the area of pentagon
 */

import java.util.Scanner;

public class Area_of_a_pentagon {

	public static void main(String[] args) {
		Scanner imput = new Scanner(System.in);
		
		//prompt the user to enter the length from the center of a pentagon to a vertex
		System.out.println("enter the length from the center of a pentagon to a vertex");
		
		double radius = imput.nextDouble();
		
		//compute the lengthOfSide 
		double lengthOfSide = (2*radius)*(Math.sin(Math.PI/5));
		
		//compute the area
		double Area = (5*(Math.pow(lengthOfSide, 2))) / (4*(Math.tan(Math.PI / 5)));
		
		//Display result
		System.out.println("the area of pentagon is: " + Area);

	}

}