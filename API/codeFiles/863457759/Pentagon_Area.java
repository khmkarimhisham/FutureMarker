
/*   
 *Write a program that prompts the user to enter
 *the length from the center of a pentagon to a vertex and computes the area of the
 *pentagon, as shown in the attached figure.
       /////////////////////////////
		@author Ahmed Sherif                  
		@id     220181144                        
		@version 1.0                          
		@since 16 march 2019
      ///////////////////////////////		
 */
import java.util.Scanner;

public class Pentagon_Area {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        // prompt the user to enter the length from the center of a pentagon to a vertex
        System.out.print("Enter the length from the center to a vertex: ");
        double r = input.nextDouble();

        // calculate  the area of the pentagon by using  Trigonometric Methods
        double s = (2 * r) * Math.sin(Math.PI / 5);
        double area = (5 * Math.pow(s, 2)) / (4 * Math.tan(Math.PI / 5)); //49.44

        System.out.printf("The area of the pentagon is %.2f\n", area);
    }
}