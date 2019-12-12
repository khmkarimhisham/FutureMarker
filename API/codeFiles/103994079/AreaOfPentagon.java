// Name: Bishoy Hani Milad
// Id:220180414

package area.of.pentagon;

import java.util.Scanner;

public class AreaOfPentagon {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        System.out.println("Enter the length from the center to the vertex of the pentagon: ");
double r= input.nextDouble();
double s=(2 * r) * Math.sin(Math.PI / 5);
double Area = (5 * Math.pow(s, 2)) / (4 * Math.tan(Math.PI / 5));
        System.out.printf("The area of the prntagon is  %5.2f \n", Area );
    }

}