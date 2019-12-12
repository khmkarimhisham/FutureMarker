/*
*A program that prompts the user to enter
*the length from the center of a pentagon to a vertex and computes the area of the
*pentagon, as shown in the attached figure.
* @author: Ahmed Nasser Hamdy
* @id: 220180462
* @version: 1.0
* @since: 23 March 2019
 */
package area.of.a.pentagon;

import java.util.Scanner;

public class AreaOfAPentagon {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        System.out.println("Enter the length from the center to vertex: ");
        double length1 = input.nextDouble();
        double length2 = (2 * length1) * Math.sin(Math.PI / 5);
        double area = (5 * Math.pow(length2, 2)) / (4 * Math.tan(Math.PI / 5));
        System.out.printf("The area of the pentagon is %5.2f\n", area);
    }

}