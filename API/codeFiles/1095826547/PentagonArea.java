/*
 * @Author: Abubakr Ahmed Fayez
 * ID: 220180068
 * Version: 1.0
 * Application: Area of a pentagon
 * @Since 23 Mar..
 */
package FutureACSolutions;

import java.util.Scanner;

public class PentagonArea {
	public static void main(String[] args) {
		Scanner input = new Scanner(System.in);
		
		System.out.print("Enter the length from the center to a vertex: "); // User Prompt
		double length = input.nextDouble(); // Call Method
		
		double side = (2 * length) * Math.sin(Math.PI / 5); //The length of the Side
		double area = (5 * Math.pow(side, 2)) / (4 * Math.tan(Math.PI / 5)); // Area Computing

		System.out.println("The area of the pentagon is " + area); // The Display
	}
}