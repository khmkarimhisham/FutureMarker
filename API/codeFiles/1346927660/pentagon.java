
/*name  :Abdelrahman Gamal 
 * id   :220180549
 * title:Area of a pentagon
 */
import java.util.Scanner;

public class pentagon {

	public static void main(String[] args) {
		final double pai = 3.14;
		Scanner input = new Scanner(System.in);
		System.out.println("enter the length from the center of a pentagon to a vertex");
		double r = input.nextDouble();
		double s = Math.sin(pai / 5) * 2 * r;
		double area = Math.pow(s, 2) * 5 / (4 * Math.tan(pai / 5));
		System.out.printf("the area of the pentagon is%.2f %n", area);
	}

}