/**
 * @author:Ashraf Khaled Farouk
 * @id:220180362
 * @since :23 /3 
 */
package area;

import java.util.Scanner;

public class Area {

    public static void main(String[] args) {
      Scanner input = new Scanner(System.in);
        System.out.print("enter the length from the center of pentagon ");
        double length = input.nextDouble();
        double side = 2 * length * Math.sin(Math.PI / 5);
        double area = (5 * Math.pow(side, 2)) / (4 * Math.tan(Math.PI / 5));
        System.out.printf("the area of pentagon is: %4.2f", area);

    }
    
}