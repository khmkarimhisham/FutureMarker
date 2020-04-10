package api;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.sql.ResultSet;
import java.sql.SQLException;

public class DoingAssignment {

    private static String Student_ID;
    private static String Assignment_ID;
    private static String Assignment_dir;
    private static int Compilation_grade;
    private static String Compilation_feedback;
    private static int Style_grade;
    private static float Comment_grade;
    private static String Comment_feedback;
    private static float Indentation_grade;
    private static String Indentation_feedback;
    private static float Identifiers_grade;
    private static String Identifiers_feedback;
    private static float Methods_grade;
    private static String Methods_feedback;
    private static int Dynamic_test_grade;
    private static String Dynamic_test_feedback;
    private static int Feature_test_grade;
    private static String Feature_test_feedback;
    private static int Lines_count = -1;

    /**
     * @param aStudent_ID the Student_ID to set
     */
    public static void setStudent_ID(String aStudent_ID) {
        Student_ID = aStudent_ID;
    }

    /**
     * @param aAssignment_ID the Assignment_ID to set
     */
    public static void setAssignment_ID(String aAssignment_ID) {
        Assignment_ID = aAssignment_ID;
    }

    /**
     * @param aAssignment_dir the Assignment_dir to set
     */
    public static void setAssignment_dir(String aAssignment_dir) {
        Assignment_dir = aAssignment_dir;
    }

    /**
     * @param aCompilation_grade the Compilation_grade to set
     */
    public static void setCompilation_grade(int aCompilation_grade) {
        Compilation_grade = aCompilation_grade;
    }

    /**
     * @param aCompilation_feedback the Compilation_feedback to set
     */
    public static void setCompilation_feedback(String aCompilation_feedback) {
        Compilation_feedback = aCompilation_feedback;
    }

    /**
     * @param aStyle_grade the Style_grade to set
     */
    public static void setStyle_grade() {
        Style_grade = Math.round(((Comment_grade + Indentation_grade + Identifiers_grade) / 3) * Assignment.getStyle_grade());
    }

    /**
     * @param aComment_feedback the Comment_feedback to set
     */
    public static void setComment_feedback(String aComment_feedback) {
        Comment_feedback = aComment_feedback;
    }

    /**
     * @param aIndentation_feedback the Indentation_feedback to set
     */
    public static void setIndentation_feedback(String aIndentation_feedback) {
        Indentation_feedback = aIndentation_feedback;
    }

    /**
     * @param aIdentifiers_feedback the Identifiers_feedback to set
     */
    public static void setIdentifiers_feedback(String aIdentifiers_feedback) {
        Identifiers_feedback = aIdentifiers_feedback;
    }

    /**
     * @param aMethods_feedback the Methods_feedback to set
     */
    public static void setMethods_feedback(String aMethods_feedback) {
        Methods_feedback = aMethods_feedback;
    }

    /**
     * @param aDynamic_test_grade the Dynamic_test_grade to set
     */
    public static void setDynamic_test_grade(int aDynamic_test_grade) {
        Dynamic_test_grade = aDynamic_test_grade;
    }

    /**
     * @param aDynamic_test_feedback the Dynamic_test_feedback to set
     */
    public static void setDynamic_test_feedback(String aDynamic_test_feedback) {
        Dynamic_test_feedback = aDynamic_test_feedback;
    }

    /**
     * @param aFeature_test_grade the Feature_test_grade to set
     */
    public static void setFeature_test_grade(int aFeature_test_grade) {
        Feature_test_grade = aFeature_test_grade;
    }

    /**
     * @param aFeature_test_feedback the Feature_test_feedback to set
     */
    public static void setFeature_test_feedback(String aFeature_test_feedback) {
        Feature_test_feedback = aFeature_test_feedback;
    }

    /**
     * @return the Student_ID
     */
    public static String getStudent_ID() {
        return Student_ID;
    }

    /**
     * @return the Assignment_ID
     */
    public static String getAssignment_ID() {
        return Assignment_ID;
    }

    /**
     * @return the Assignment_dir
     */
    public static String getAssignment_dir() {
        return Assignment_dir;
    }

    /**
     * @return the Compilation_grade
     */
    public static int getCompilation_grade() {
        return Compilation_grade;
    }

    /**
     * @return the Compilation_feedback
     */
    public static String getCompilation_feedback() {
        return Compilation_feedback;
    }

    /**
     * @return the Style_grade
     */
    public static int getStyle_grade() {
        return Style_grade;
    }

    /**
     * @return the Comment_feedback
     */
    public static String getComment_feedback() {
        return Comment_feedback;
    }

    /**
     * @return the Indentation_feedback
     */
    public static String getIndentation_feedback() {
        return Indentation_feedback;
    }

    /**
     * @return the Identifiers_feedback
     */
    public static String getIdentifiers_feedback() {
        return Identifiers_feedback;
    }

    /**
     * @return the Methods_feedback
     */
    public static String getMethods_feedback() {
        return Methods_feedback;
    }

    /**
     * @return the Dynamic_test_grade
     */
    public static int getDynamic_test_grade() {
        return Dynamic_test_grade;
    }

    /**
     * @return the Dynamic_test_feedback
     */
    public static String getDynamic_test_feedback() {
        return Dynamic_test_feedback;
    }

    /**
     * @return the Feature_test_grade
     */
    public static int getFeature_test_grade() {
        return Feature_test_grade;
    }

    /**
     * @return the Feature_test_feedback
     */
    public static String getFeature_test_feedback() {
        return Feature_test_feedback;
    }

    /**
     * @return the Comment_grade
     */
    public static float getComment_grade() {
        return Comment_grade;
    }

    /**
     * @param aComment_grade the Comment_grade to set
     */
    public static void setComment_grade(float aComment_grade) {
        Comment_grade = aComment_grade;
    }

    /**
     * @return the Indentation_grade
     */
    public static float getIndentation_grade() {
        return Indentation_grade;
    }

    /**
     * @param aIndentation_grade the Indentation_grade to set
     */
    public static void setIndentation_grade(float aIndentation_grade) {
        Indentation_grade = aIndentation_grade;
    }

    /**
     * @return the Identifiers_grade
     */
    public static float getIdentifiers_grade() {
        return Identifiers_grade;
    }

    /**
     * @param aIdentifiers_grade the Identifiers_grade to set
     */
    public static void setIdentifiers_grade(float aIdentifiers_grade) {
        Identifiers_grade = aIdentifiers_grade;
    }

    /**
     * @return the Methods_grade
     */
    public static float getMethods_grade() {
        return Methods_grade;
    }

    /**
     * @param aMethods_grade the Methods_grade to set
     */
    public static void setMethods_grade(float aMethods_grade) {
        Methods_grade = aMethods_grade;
    }

    public static void sql_insert() {
        try {
            String sql = "INSERT INTO `doing_assignment`(`Student_ID`, `Assignment_ID`, `Assignment_dir`, `Assignment_main`, `Compilation_grade`, `Compilation_feedback`, `Style_grade`, `Comment_feedback`, `Indentation_feedback`, `Methods_feedback`, `Identifiers_feedback`, `Dynamic_test_grade`, `Dynamic_test_feedback`, `Feature_test_grade`, Feature_test_feedback) VALUES ('" + Student_ID + "', '" + Assignment_ID + "', '" + Assignment_dir + "', '" + Assignment_dir + "', '" + Compilation_grade + "', '" + Compilation_feedback + "', '" + Style_grade + "', '" + Comment_feedback + "', '" + Indentation_feedback + "', null, '" + Identifiers_feedback + "', '" + Dynamic_test_grade + "', '" + Dynamic_test_feedback + "', '" + Feature_test_grade + "', '" + Feature_test_feedback + "')";
            int result = DB.SQLStmt().executeUpdate(sql);

            if (result == 1) {
                System.out.println("true");
            } else {
                System.out.println("false");
            }
        } catch (SQLException e) {
        }
    }

    /**
     * @return the Lines_count
     */
    public static int getLines_count() {
        if (Lines_count == -1) {
            int counter = 0;
            String line;

            try {
                BufferedReader reader = new BufferedReader(new FileReader(Assignment_dir));
                while ((line = reader.readLine()) != null) {
                    counter++;
                }
                reader.close();
                Lines_count = counter;
            } catch (IOException e) {
            }

            return counter;
        } else {
            return Lines_count;
        }
    }

    public static void tostring() {
        System.out.println("Student_ID=" + Student_ID);
        System.out.println("Assignment_ID=" + Assignment_ID);
        System.out.println("Assignment_dir=" + Assignment_dir);
        System.out.println("Compilation_grade=" + Compilation_grade);
        System.out.println("Compilation_feedback=" + Compilation_feedback);
        System.out.println("Style_grade=" + Style_grade);
        System.out.println("Comment_grade=" + Comment_grade);
        System.out.println("Comment_feedback=" + Comment_feedback);
        System.out.println("Indentation_grade=" + Indentation_grade);
        System.out.println("Indentation_feedback=" + Indentation_feedback);
        System.out.println("Identifiers_grade=" + Identifiers_grade);
        System.out.println("Identifiers_feedback=" + Identifiers_feedback);
        System.out.println("Methods_grade=" + Methods_grade);
        System.out.println("Methods_feedback=" + Methods_feedback);
        System.out.println("Dynamic_test_grade=" + Dynamic_test_grade);
        System.out.println("Dynamic_test_feedback=" + Dynamic_test_feedback);
        System.out.println("Feature_test_grade=" + Feature_test_grade);
        System.out.println("Feature_test_feedback=" + Feature_test_feedback);
        System.out.println("Lines_count=" + Lines_count);
    }
}
