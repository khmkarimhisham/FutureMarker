
/**
 * 
 * @author Esraa Sayed
 *ID: 220180990
 *Assignment: program that computes the area of the pentagon
 *
*/
import java.util.Scanner;

public class AreaOfPentagon {

	public static void main(String[] args) {
		System.out.println("Please enter the length from the center of a pentagon to a vertex: ");

		Scanner input = new Scanner(System.in);
		// "r" is the length from the center of a pentagon to a vertex entered by user
		double r = input.nextDouble();
		
		// "s" is the length of the side, then the side can be computed by following formula
		double s = (2 * r) * Math.sin(Math.PI / 5);
		
		// now we can compute the area of the pentagon
		double area = (5 * Math.pow(s, 2)) / (4 * Math.tan(Math.PI / 5));
		
		//round up two digits after decimal point
		double area_rounded = Math.round(area * 100.0) / 100.0;
		
		System.out.println("The area of the pentagon is " + area_rounded);
	}

}