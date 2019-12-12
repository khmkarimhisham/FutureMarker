/*
 * *the AreaOfAPentagon program implements an applicatoin that
 * simply prompts the user to enter the length from the center of a pentagon to 
a vertex then computes and display the area of the pentagon
 */
package area.of.a.pentagon;

import java.util.Scanner;

/**
 * @author Abdallah Ezzo
 * @ID 220180005
 * @version 1.0
 * @since 23 Mar 2019
 */
public class AreaOfAPentagon {
    public static void main(String[] args) {
        /** 
         * user enter the the length from the center of a pentagon to 
a vertex
* the length from the center of a pentagon to a vertex = r
* side length of the pentagon = s
* area of the pentagon = a
*/
        System.out.print("Enter the length from the center of a pentagon to a vertex : " );
        Scanner input = new Scanner (System.in);
        
        double r = input.nextDouble();
        /**
         * compute s from r
         */ 
        double s = r*0.02193333345229896414504370591042;
        
        /**
         * compute a from 
         */
        double a = (s*s)*113.98176229970004925466973036952;
        /**
         * display a
         */
        System.out.println("area of the pentagon = "+a);
    }
    
}