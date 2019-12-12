/**
 *Write a program that prompts the user to enter
 *the length from the center of a pentagon to a vertex and computes the area of the
 *pentagon, as shown in the attached figure
 * @author name Abeer Reda
 * @id 220180055
 * @version 1.0
 * @since 23 March 2019
 */
package Pentagonarea;
import java.util.Scanner;
public class Pentagonarea {

 
    public static void main(String[] args) {
       Scanner in = new Scanner (System.in);
       
       System.out.print("enter the length from the center of a pentagon: \n");
       double r = in.nextDouble();
       
       double s = (2 * r) * Math.sin(3.14/ 5); 
       double a = (5 * Math.pow(s,2))/(4*Math.tan(3.14/5));
       
       System.out.printf("The area of the pentagon is %.2f\n", a);
       
       
       
    }

}