package com.tarot.vue;

import com.tarot.model.ArcanesMajeures;
import com.tarot.model.Card;

import javax.swing.*;
import java.awt.*;

public class PanelForArcanesMajeureDetail extends AbstractPanelForArcanesType{


    private final JPanel panelSortOf = new JPanel(new GridLayout(1,1));
        private final JLabel sortOf = new JLabel();
        private final JButton iconSetSortOf = new JButton();
    private final JPanel panelElement = new JPanel(new GridLayout(1,1));
     private final JLabel element = new JLabel();
        private final JButton iconSetElement = new JButton();


    private final JComboBox comboBoxElement = new JComboBox();
        String elementsModel[] = {"Choisissez...","Feu", "Terre", "Air","Eau", "Tous"};
        private final DefaultComboBoxModel modelElement = new DefaultComboBoxModel(elementsModel);
    private final JComboBox comboBoxSortOf = new JComboBox();
        String sortOfModel[] = {"Choisissez...","Masculin", "Feminin", "Androgine","Neutre"};
        private final DefaultComboBoxModel modelSortOf = new DefaultComboBoxModel(sortOfModel);

    GridLayout gbL = new GridLayout(4,1);


    /**
     * Constructor
     * @param c the currently card detailPanel shows
     */
    public PanelForArcanesMajeureDetail(ArcanesMajeures c)
    {
        super();
        initComponent();
        this.currentCard = c;
        this.name.setText(this.currentCard.getNom());
        this.number.setText(this.currentCard.getNumber());
        this.element.setText(this.currentCard.getElement());
        this.sortOf.setText(this.currentCard.getSortOf());
        setStyleComponent();
        this.fillHashMap();


    }

    /**
     * init Component and add button to a listener and the correct hashmap
     */
    public void initComponent() {


        super.initComponent();
        this.setLayout(gbL);
        this.setOpaque(false);
        this.setBackground(new Color(3,3,32));
        this.panelElement.setName("panelElement");
        this.comboBoxElement.setModel(this.modelElement);
        this.setPreferredSize(new Dimension(100,30));
        this.iconSetElement.setIcon(new ImageIcon(getClass().getResource("/images/").getPath()+"edit.png"));
        this.panelElement.add(this.element);
        VueTest.mapBtnHoverAction.put(this.element,this);
        this.element.addMouseListener(btnAct);
        this.panelElement.add(this.iconSetElement);
        VueTest.mapBtnHoverAction.put(this.iconSetElement,this);
        VueTest.mapBtnClickAction.put(this.iconSetElement,this);
        this.iconSetElement.addMouseListener(btnAct);
        VueTest.mapBtnHoverAction.put(this.comboBoxElement,this);
        this.comboBoxElement.addMouseListener(btnAct);

        this.panelSortOf.setName("panelSortOf");
        this.comboBoxSortOf.setModel(this.modelSortOf);
        this.iconSetSortOf.setIcon(new ImageIcon(getClass().getResource("/images/").getPath()+"edit.png"));
        this.panelSortOf.add(this.sortOf);
        VueTest.mapBtnHoverAction.put(this.sortOf,this);
        this.sortOf.addMouseListener(btnAct);
        this.panelSortOf.add(this.iconSetSortOf);
        VueTest.mapBtnHoverAction.put(this.iconSetSortOf,this);
        VueTest.mapBtnClickAction.put(this.iconSetSortOf,this);
        this.iconSetSortOf.addMouseListener(btnAct);
        VueTest.mapBtnHoverAction.put(this.comboBoxSortOf,this);
        this.comboBoxSortOf.addMouseListener(btnAct);


        this.panelElement.setBackground(new Color(50,51,50));
        this.add(this.panelElement);
        this.panelSortOf.setBackground(new Color(50,51,50));
        this.add(this.panelSortOf);
    }

    /**
     * To set the properties the labels components turn into JtextField or JComboBox
     * a HashMap is created to link JLabel and JTextField/JComboBox that are in the same panel
     * (panel planet)
     * after a super one
     */
    public void fillHashMap()
    {
        super.fillHashMap();
        this.fieldAndHisKey.put(this.panelSortOf.getName(),this.comboBoxSortOf);
        this.fieldAndHisKey.put(this.panelElement.getName(),this.comboBoxElement);
        this.labelAndHisKey.put(this.panelSortOf.getName(),this.sortOf);
        this.labelAndHisKey.put(this.panelElement.getName(),this.element);
    }

    /**
     * set differents style to the components after a super one
     */
    public void setStyleComponent(){

        super.setStyleComponent();
        this.element.setForeground(Color.WHITE);
        this.sortOf.setForeground(Color.WHITE);

    }


    /**
     *
     * @return the new card that will replace the old one in the collection card
     */
    @Override
    public Card modifyCardAfterValidForm() {
        return new ArcanesMajeures(this.number.getText(), this.currentCard.getPicture(), this.name.getText(), this.sortOf.getText(), this.element.getText());
    }

    /**
     * reset the state of panel planet and sortOf panel
     */
    public void resetStateField()
    {
        super.resetStateField();
        this.panelElement.remove(0);
        this.panelElement.add(this.element,0);
        this.panelElement.getComponent(0).setVisible(true);
        ((JButton)this.panelElement.getComponent(1)).setIcon((new ImageIcon(getClass().getResource("/images/").getPath() + "edit.png")));
        this.panelSortOf.remove(0);
        this.panelSortOf.add(this.sortOf,0);
        this.panelSortOf.getComponent(0).setVisible(true);
        ((JButton)this.panelSortOf.getComponent(1)).setIcon((new ImageIcon(getClass().getResource("/images/").getPath() + "edit.png")));
    }

}
